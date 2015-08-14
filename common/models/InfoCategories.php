<?php

namespace common\models;
use common\models\Info;
use common\models\InfoCategory;

use Yii;

/**
 * This is the model class for table "{{%info_attachment}}".
 *
 * @property integer $id
 * @property integer $info_id
 * @property integer $category_id
 *
 *
 * @property Info $info
 */
class InfoCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%info_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['info_id', 'category_id'], 'required'],
            [['info_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'info_id' => Yii::t('common', 'Info ID'),
            'category_id' => Yii::t('common', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfo()
    {
        return $this->hasOne(Info::className(), ['id' => 'info_id']);
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(InfoCategory::className(), ['id' => 'category_id']);
    }
}
