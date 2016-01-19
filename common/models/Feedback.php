<?php

namespace common\models;

use common\models\query\FeedbackQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
//use common\behaviors\ChangeLogBehavior;



class Feedback extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT     = 0;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%feedback_form}}';
    }

    /**
     * @return FeedbackQuery
     */
    public static function find()
    {
        return new FeedbackQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
//            [
//                'class' => ChangeLogBehavior::className(),
//            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['text'], 'string'],
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
            'text'           => Yii::t('common', 'Text'),

            'status'         => Yii::t('common', 'Published'),

            'created_at'     => Yii::t('common', 'Created At'),
            'updated_at'     => Yii::t('common', 'Updated At'),

            'domain_id'      => Yii::t('common', 'Domain ID'),

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

//    public function afterDelete()
//    {
//        $feedback = Feedback::find()->andWhere([
//
//                'domain_id'       => Yii::$app->user->identity->domain_id
//            ])->one();
//
//        if ($feedback) {
//            $feedback->delete();
//        }
//
//        return parent::afterDelete();
//    }

//    p

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

//    public static function multiSave($about)
//    {
//
//        //\yii\helpers\VarDumper::dump(Yii::$app->request->post(),11,1); die();
//
//        $defaultAttributes = [];
//
//        foreach ($about->getModels() as $key => $v) {
//
//            foreach ($about->getModel($key)->attributes() as $attrKey) {
//                if (empty($defaultAttributes[$attrKey])) {
//                    if (!empty($about->getModel($key)->$attrKey)) {
//                        if ('[]' != $about->getModel($key)->$attrKey) {
//                            $defaultAttributes[$attrKey] = $about->getModel($key)->$attrKey;
//                        }
//                    }
//                }
//            }
//        }
//
//        unset($defaultAttributes['id']);
//        unset($defaultAttributes['locale']);
//        unset($defaultAttributes['locale_group_id']);
//        //unset($defaultAttributes['slug']);
//
//        $groupId = self::getLastLocaleGroupId() + 1;
//
//        foreach ($about->getModels() as $key => $v) {
//            if (!$about->getModel($key)->locale_group_id) {
//                $about->getModel($key)->locale_group_id = $groupId;
//            }
//
//            foreach ($defaultAttributes as $key2 => $value2) {
//                if (empty($about->getModel($key)->$key2) or "[]" == $about->getModel($key)->$key2) {
//                    $about->getModel($key)->$key2 = $value2;
//                }
//            }
//
//            //\yii\helpers\VarDumper::dump($about->getModel($key),11,1);
//        }
//
//
//        return $about->save();
//    }

//    public static function getLeftMenuItems()
//    {
//        $items  = [];
//        //['label' => Yii::t('backend', 'Models'), 'url' => ['/about/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
//        $abouts = self::find()
//            ->published()
//            ->andWhere(['locale' => Yii::$app->language])
//            //->andWhere(['domain_id' => Yii::$app->user->identity->domain_id])
//            ->all();
//
//        foreach ($abouts as $about) {
//            $items[] = [
//                'label'  => Yii::t('backend', $about->title),
//                'url'    => ['/about-page/index', 'mid' => $about->id],
//                'icon'   => '<i class="fa fa-angle-double-right"></i>',
//                'active' => self::isActiveMenuItem($about->id, $about->locale)
//            ];
//        }
//
//        return $items;
//    }

//    private static function isActiveMenuItem($mid, $locale)
//    {
//        $result = false;
//
//        if (preg_match('/^about-page/', Yii::$app->request->pathinfo)) {
//            if ($mid == Yii::$app->request->get('mid')) {
//                $result = true;
//            }
//        }
//
//        if (preg_match('/^about-page\/update/', Yii::$app->request->pathinfo)) {
//            if (Yii::$app->request->get('id')) {
//                $model           = AboutPage::findOne(['id' => Yii::$app->request->get('id')]);
//                $localGroupModel = AboutPage::findOne(['locale_group_id' => $model->locale_group_id, 'locale' => $locale]);
//
//                if ($model and $mid == $model->about_id) {
//                    $result = true;
//                }
//            }
//        }
//
//        return $result;
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getLocaleGroupPages()
//    {
//        $query = new AboutQuery(get_called_class());
//
//        return $query->localeGroupPages($this);
//    }
}