<?php

namespace common\models;
use common\models\FinancePage;
use common\models\FinancePageCategory;

use Yii;

/**
 * This is the model class for table "{{%finance_page_attachment}}".
 *
 * @property integer $id
 * @property integer $finance_page_id
 * @property integer $category_id
 *
 *
 * @property FinancePage $finance_page
 */
class FinancePageCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%finance_page_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['finance_page_id', 'category_id'], 'required'],
            [['finance_page_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'finance_page_id' => Yii::t('common', 'FinancePage ID'),
            'category_id' => Yii::t('common', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancePage()
    {
        return $this->hasOne(FinancePage::className(), ['id' => 'finance_page_id']);
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(FinancePageCategory::className(), ['id' => 'category_id']);
    }
}
