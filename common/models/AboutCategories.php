<?php

namespace common\models;
use common\models\About;
use common\models\AboutCategory;

use Yii;

/**
 * This is the model class for table "{{%about_attachment}}".
 *
 * @property integer $id
 * @property integer $about_id
 * @property integer $category_id
 *
 *
 * @property About $about
 */
class AboutCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%about_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['about_id', 'category_id'], 'required'],
            [['about_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'about_id' => Yii::t('common', 'About ID'),
            'category_id' => Yii::t('common', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbout()
    {
        return $this->hasOne(About::className(), ['id' => 'about_id']);
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(AboutCategory::className(), ['id' => 'category_id']);
    }
}
