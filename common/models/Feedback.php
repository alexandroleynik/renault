<?php

namespace common\models;

use common\models\query\FeedbackQuery;
use Yii;
use yii\behaviors\TimestampBehavior;




class Feedback extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT     = 0;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%feedback_form}}';
    }

    /**
     * @return FeedbackQuery
     */
    public static function find()
    {
        return new FeedbackQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
//            [
//                'class' => ChangeLogBehavior::className(),
//            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['text'], 'string'],
            //[['published_at'], 'default', 'value' => time()],
            //[['published_at'], 'filter', 'filter' => 'strtotime'],
            [['subject'], 'string', 'max' => 128],
            [['status', 'domain_id'], 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'             => Yii::t('common', 'ID'),
            'text'           => Yii::t('common', 'Text'),
            'subject'        => Yii::t('common', 'Subject'),
            'status'         => Yii::t('common', 'Status'),

            'created_at'     => Yii::t('common', 'Created At'),
            'updated_at'     => Yii::t('common', 'Updated At'),

            'domain_id'      => Yii::t('common', 'User'),

        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            /* else {
              $this->published_at = strtotime($this->published_at);
              } */

            if (empty($this->domain_id)) {
                $this->domain_id = Yii::$app->user->identity->domain_id;
            }

            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    public static function getLocaleInstance($locale)
    {
        $name = self::getLocaleClassName($locale, self::getClassNameNoNamespace());
        return new $name();
    }

    public static function getClassNameNoNamespace()
    {
        return substr(
            self::className(), strrpos(self::className(), '\\') + 1
        );
    }

    public static function getLocaleClassName($locale, $className)
    {
        return str_replace(
            $className, 'locale\\' . $className . ucfirst(str_replace('-', '', $locale)), self::className()
        );
    }

    public static function getLastLocaleGroupId()
    {
        $about = self::find()->orderBy("locale_group_id DESC")->one();
        if ($about) {
            return $about->locale_group_id;
        } else {
            return 0;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'domain_id']);
    }

}