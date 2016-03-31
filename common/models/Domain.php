<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\behaviors\ChangeLogBehavior;
use trntv\filekit\behaviors\UploadBehavior;

/**
 * This is the model class for table "domain".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property string $locale
 * @property integer $locale_group_id
 * @property integer $dealer_id
 *
 * @property string $logo_path
 * @property string $logo_base_url
 * @property string $m_logo_path
 * @property string $m_logo_base_url
 *
 * @property string $desktopLogoUrl
 * @property string $mobileLogoUrl
 */


class Domain extends \yii\db\ActiveRecord
{

    public $logo;
    public $m_logo;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => ChangeLogBehavior::className(),
            ],
            'logo' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'logo',
                'pathAttribute' => 'logo_path',
                'baseUrlAttribute' => 'logo_base_url'
            ],
            'm_logo' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'm_logo',
                'pathAttribute' => 'm_logo_path',
                'baseUrlAttribute' => 'm_logo_base_url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%domain}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'status','av_locale', 'locale_group_id', 'dealer_id'], 'integer'],
            [['title', 'description', 'locale'], 'string', 'max' => 255],
            [['m_logo_path', 'm_logo_base_url','logo_path', 'logo_base_url'], 'string', 'max' => 1024],
            [['logo','m_logo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'              => Yii::t('common', 'ID'),
            'title'           => Yii::t('common', 'Title'),
            'description'     => Yii::t('common', 'Description'),
            'created_at'      => Yii::t('common', 'Created At'),
            'updated_at'      => Yii::t('common', 'Updated At'),
            'status'          => Yii::t('common', 'Status'),
            'locale'          => Yii::t('common', 'Locale'),
            'locale_group_id' => Yii::t('common', 'Locale Group ID'),
            'dealer_id'       => Yii::t('common', 'Dealer ID'),
            'av_locale'       => Yii::t('common', 'Avalible Locale'),
            'logo'            => Yii::t('common', 'Logo'),
            'm_logo'          => Yii::t('common', 'M_logo'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\DomainQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DomainQuery(get_called_class());
    }

    public static function getFrontendUrl() {
        $url = '';
        if (Yii::$app->user->identity->domain_id > 0) {
            $url = 'http://'. Yii::$app->user->identity->domain->title;
        }
        else {
            $url = Yii::getAlias('@frontendUrl');
        }

        return $url;
        
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Yii::$app->session->setFlash('forceUpdateLocale');
    }

    /*
    * @return bool|string 
    */

    public function getDesktopLogoUrl()
    {
        return $this->logo_path
            ? Yii::getAlias($this->logo_base_url . '/' . $this->logo_path)
            : false;
    }


    /*
    * @return bool|string 
    */


    public function getMobileLogoUrl()
    {
        return $this->m_logo_path
            ? Yii::getAlias($this->m_logo_base_url . '/' . $this->m_logo_path)
            : false;
    }

}