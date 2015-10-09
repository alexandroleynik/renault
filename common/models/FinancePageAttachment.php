<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%financePage_attachment}}".
 *
 * @property integer $id
 * @property integer $finance_page_id
 * @property string $base_url
 * @property string $path
 * @property string $url
 * @property string $name
 * @property string $type
 * @property string $size
 *
 * @property FinancePage $financePage
 */
class FinancePageAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%finance_page_attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['finance_page_id', 'path'], 'required'],
            [['finance_page_id', 'size'], 'integer'],
            [['base_url', 'path', 'type', 'name'], 'string', 'max' => 255]
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
            'base_url' => Yii::t('common', 'Base Url'),
            'path' => Yii::t('common', 'Path'),
            'size' => Yii::t('common', 'Size'),
            'type' => Yii::t('common', 'Type'),
            'name' => Yii::t('common', 'Name')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancePage()
    {
        return $this->hasOne(FinancePage::className(), ['id' => 'finance_page_id']);
    }

    public function getUrl()
    {
        return $this->base_url .'/'. $this->path;
    }
}
