<?php

namespace common\models;

use common\models\query\PromoCategoryQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "promo_category".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property integer $status
 * @property integer $weight
 *
 * @property Promo[] $promos
 */
class PromoCategory extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%promo_category}}';
    }

    /**
     * @return PromoCategoryQuery
     */
    public static function find()
    {
        return new PromoCategoryQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class'=>SluggableBehavior::className(),
                'attribute'=>'title'
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
            [['status', 'weight'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'slug' => Yii::t('common', 'Slug'),
            'title' => Yii::t('common', 'Title'),
            'parent_id' => Yii::t('common', 'Parent Category'),
            'status' => Yii::t('common', 'Active'),
            'weight' => Yii::t('common', 'Weight')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromos()
    {
        return $this->hasMany(Promo::className(), ['category_id' => 'id']);
    }
}
