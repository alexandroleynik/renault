<?php

namespace common\models;
use common\models\AboutPage;
use common\models\AboutPageCategory;

use Yii;

/**
 * This is the model class for table "{{%about_page_attachment}}".
 *
 * @property integer $id
 * @property integer $about_page_id
 * @property integer $category_id
 *
 *
 * @property AboutPage $about_page
 */
class AboutPageCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%about_page_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['about_page_id', 'category_id'], 'required'],
            [['about_page_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'about_page_id' => Yii::t('common', 'AboutPage ID'),
            'category_id' => Yii::t('common', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAboutPage()
    {
        return $this->hasOne(AboutPage::className(), ['id' => 'about_page_id']);
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(AboutPageCategory::className(), ['id' => 'category_id']);
    }
}
