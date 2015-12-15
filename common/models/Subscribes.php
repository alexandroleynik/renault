<?php

namespace common\models;

use common\models\query\SubscribesQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use common\behaviors\ChangeLogBehavior;

/**
 * This is the model class for table "subscribes".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $description 
 * @property string $body
 * @property string $on_scenario
 * @property string $before_body
 * @property string $after_body
 * @property string $locale 
 * @property integer $status  
 * @property integer $locale_group_id  
 * @property integer $domain_id
 *
 */
class Subscribes extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT     = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subscribe_form}}';
    }

    /**
     * @return BlockQuery
     */
    public static function find()
    {
        return new SubscribesQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['slug', 'unique', 'targetAttribute' => ['slug', 'locale', 'domain']],
            [['firstname', 'secondname', 'lastname', 'email', 'phone'], 'string'],
            [['status', 'domain_id'], 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'firstname' => Yii::t('common', 'Firstname'),
            'secondname' => Yii::t('common', 'Secondname'),
            'lastname' => Yii::t('common', 'Lastname'),
            'email'  => Yii::t('common', 'Email'),
            'phone'  => Yii::t('common', 'Phone'),

            'status'      => Yii::t('common', 'Status'),
            'domain_id'   => Yii::t('common', 'Domain ID')

        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (empty($this->domain_id)) {
                $this->domain_id = Yii::getAlias('@domainId');
            }

            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        return parent::afterSave($insert, $changedAttributes);
    }

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



//    public static function multiSave($model)
//    {
//
//        //\yii\helpers\VarDumper::dump(Yii::$app->request->post(),11,1); die();
//
//        $defaultAttributes = [];
//
//        foreach ($model->getModels() as $key => $v) {
//
//            foreach ($model->getModel($key)->attributes() as $attrKey) {
//                if (empty($defaultAttributes[$attrKey])) {
//                    $defaultAttributes[$attrKey] = $model->getModel($key)->$attrKey;
//                }
//            }
//        }
//
//        unset($defaultAttributes['id']);
//        unset($defaultAttributes['locale']);
//        unset($defaultAttributes['locale_group_id']);
//
//        $groupId = self::getLastLocaleGroupId() + 1;
//
//        foreach ($model->getModels() as $key => $v) {
//            if (!$model->getModel($key)->locale_group_id) {
//                $model->getModel($key)->locale_group_id = $groupId;
//            }
//
//            foreach ($defaultAttributes as $key2 => $value2) {
//                if (empty($model->getModel($key)->$key2) or "[]" == $model->getModel($key)->$key2) {
//                    $model->getModel($key)->$key2 = $value2;
//                }
//            }
//
//            //\yii\helpers\VarDumper::dump($model->getModel($key),11,1);
//        }
//
//
//        return $model->save();
//    }

    public function afterDelete()
    {
        $model = Subscribes::find()->andWhere([

                'domain_id'       => Yii::$app->user->identity->domain_id
            ])->one();

        if ($model) {
            $model->delete();
        }

        return parent::afterDelete();
    }


}