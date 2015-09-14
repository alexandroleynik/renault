<?php

namespace common\models;

use common\behaviors\CacheInvalidateBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\query\WidgetTextQuery;

/**
 * This is the model class for table "text_block".
 *
 * @property integer $id
 * @property string $key
 * @property string $title
 * @property string $body
 * @property string $on_scenario
 * @property string $before_body
 * @property string $after_body
 * @property integer $status
 */
class WidgetText extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT  = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%widget_text}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'cacheInvalidate' => [
                'class' => CacheInvalidateBehavior::className(),
                'keys'  => [
                    function ($model) {
                        return [
                            self::className(),
                            $model->key
                        ];
                    }
                    ]
                ]
            ];
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['key', 'title', 'body'], 'required'],
                [['key'], 'unique'],
                [['body', 'before_body', 'after_body', 'on_scenario'], 'string'],
                [['status', 'domain_id'], 'integer'],
                [['key'], 'string', 'max' => 1024],
                [['title'], 'string', 'max' => 512],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id'          => Yii::t('common', 'ID'),
                'key'         => Yii::t('common', 'Key'),
                'title'       => Yii::t('common', 'Title'),
                'body'        => Yii::t('common', 'Body'),
                'status'      => Yii::t('common', 'Status'),
                'domain_id'   => Yii::t('common', 'Domain ID'),
                'before_body' => Yii::t('common', 'Before body'),
                'after_body'  => Yii::t('common', 'After body'),
                'on_scenario' => Yii::t('common', 'On scenario'),
            ];
        }

        /**
         * @return Query
         */
        public static function find()
        {
            return new WidgetTextQuery(get_called_class());
        }

        public function beforeSave($insert)
        {
            if (parent::beforeSave($insert)) {

                if (empty($this->domain_id)) {
                    $this->domain_id = Yii::$app->user->identity->domain_id;
                }

                return true;
            } else {
                return false;
            }
        }
    }