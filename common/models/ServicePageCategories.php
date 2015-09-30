<?php

namespace common\models;
use common\models\ServicePage;
use common\models\ServicePageCategory;

use Yii;

/**
 * This is the model class for table "{{%service_page_attachment}}".
 *
 * @property integer $id
 * @property integer $service_page_id
 * @property integer $category_id
 *
 *
 * @property ServicePage $service_page
 */
class ServicePageCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%service_page_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_page_id', 'category_id'], 'required'],
            [['service_page_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'service_page_id' => Yii::t('common', 'ServicePage ID'),
            'category_id' => Yii::t('common', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicePage()
    {
        return $this->hasOne(ServicePage::className(), ['id' => 'service_page_id']);
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ServicePageCategory::className(), ['id' => 'category_id']);
    }
}
