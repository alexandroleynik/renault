<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\behaviors\ChangeLogBehavior;

/**
 * This is the model class for table "domain".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property string $locale
 * @property integer $locale_group_id
 * @property integer $dealer_id
 */
class Domain extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'domain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'status', 'locale_group_id', 'dealer_id'], 'integer'],
            [['title', 'description', 'locale'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'              => Yii::t('common', 'ID'),
            'title'           => Yii::t('common', 'Title'),
            'description'     => Yii::t('common', 'Description'),
            'created_at'      => Yii::t('common', 'Created At'),
            'updated_at'      => Yii::t('common', 'Updated At'),
            'status'          => Yii::t('common', 'Status'),
            'locale'          => Yii::t('common', 'Locale'),
            'locale_group_id' => Yii::t('common', 'Locale Group ID'),
            'dealer_id'       => Yii::t('common', 'Dealer ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\DomainQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DomainQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => ChangeLogBehavior::className(),
            ]
        ];
    }
}