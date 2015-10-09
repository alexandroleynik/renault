<?php

namespace common\models;
use common\models\Finance;
use common\models\FinanceCategory;

use Yii;

/**
 * This is the model class for table "{{%finance_attachment}}".
 *
 * @property integer $id
 * @property integer $finance_id
 * @property integer $category_id
 *
 *
 * @property Finance $finance
 */
class FinanceCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%finance_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['finance_id', 'category_id'], 'required'],
            [['finance_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'finance_id' => Yii::t('common', 'Finance ID'),
            'category_id' => Yii::t('common', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinance()
    {
        return $this->hasOne(Finance::className(), ['id' => 'finance_id']);
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(FinanceCategory::className(), ['id' => 'category_id']);
    }
}
