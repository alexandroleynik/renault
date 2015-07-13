<?php

namespace common\models;
use common\models\Promo;
use common\models\PromoCategory;

use Yii;

/**
 * This is the model class for table "{{%promo_attachment}}".
 *
 * @property integer $id
 * @property integer $promo_id
 * @property integer $category_id
 *
 *
 * @property Promo $promo
 */
class PromoCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%promo_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promo_id', 'category_id'], 'required'],
            [['promo_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'promo_id' => Yii::t('common', 'Promo ID'),
            'category_id' => Yii::t('common', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromo()
    {
        return $this->hasOne(Promo::className(), ['id' => 'promo_id']);
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PromoCategory::className(), ['id' => 'category_id']);
    }
}
