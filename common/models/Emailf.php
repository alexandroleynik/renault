<?php

namespace common\models;

use common\models\query\EmailfQuery;
use Yii;
use yii\behaviors\TimestampBehavior;




class Emailf extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT     = 0;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%email_for_feedback_form}}';
    }

    /**
     * @return FeedbackQuery
     */
    public static function find()
    {
        return new EmailfQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['email'], 'string'],
            //[['published_at'], 'default', 'value' => time()],
            //[['published_at'], 'filter', 'filter' => 'strtotime'],

            [['status', 'domain_id'], 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'             => Yii::t('common', 'ID'),
            'email'           => Yii::t('common', 'email'),

            'status'         => Yii::t('common', 'Status email'),

            'created_at'     => Yii::t('common', 'Created At'),
            'updated_at'     => Yii::t('common', 'Updated At'),

            'domain_id'      => Yii::t('common', 'User'),

        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            /* else {
              $this->published_at = strtotime($this->published_at);
              } */

            if (empty($this->domain_id)) {
                $this->domain_id = Yii::$app->user->identity->domain_id;
            }

            return true;
        } else {
            return false;
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */


    public static function getLocaleInstance($locale)
    {
        $name = self::getLocaleClassName($locale, self::getClassNameNoNamespace());
        return new $name();
    }

    public static function getClassNameNoNamespace()
    {
        return substr(
            self::className(), strrpos(self::className(), '\\') + 1
        );
    }

    public static function getLocaleClassName($locale, $className)
    {
        return str_replace(
            $className, 'locale\\' . $className . ucfirst(str_replace('-', '', $locale)), self::className()
        );
    }

    public static function getLastLocaleGroupId()
    {
        $about = self::find()->orderBy("locale_group_id DESC")->one();
        if ($about) {
            return $about->locale_group_id;
        } else {
            return 0;
        }
    }

}