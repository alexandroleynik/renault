<?php

namespace common\models;

use common\models\query\ServiceCategoryQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "service_category".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property integer $status
 * @property integer $weight
 * @property string $domain_id
 *
 * @property Service[] $services
 */
class ServiceCategory extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT  = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_category}}';
    }

    /**
     * @return ServiceCategoryQuery
     */
    public static function find()
    {
        return new ServiceCategoryQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class'     => SluggableBehavior::className(),
                'attribute' => 'title'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 512],
            [['slug'], 'unique'],
            [['slug'], 'string', 'max' => 1024],
            [['status', 'weight', 'domain_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'        => Yii::t('common', 'ID'),
            'slug'      => Yii::t('common', 'Slug'),
            'title'     => Yii::t('common', 'Title'),
            'parent_id' => Yii::t('common', 'Parent Category'),
            'status'    => Yii::t('common', 'Active'),
            'weight'    => Yii::t('common', 'Weight'),
            'domain_id' => Yii::t('common', 'Domain ID')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['category_id' => 'id']);
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