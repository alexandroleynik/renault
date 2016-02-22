<?php

namespace common\models;

use common\models\query\PriceQuery;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

use common\behaviors\ChangeLogBehavior;


class Price extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT     = 0;

    /**
     * @var array
     */
    public $attachments;

    /**
     * @var array
     */
    public $categoriesList;

    /**
     * @var array
     */
    public $thumbnail;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%price}}';
    }

    /**
     * @return AboutQuery
     */
    public static function find()
    {
        return new PriceQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),

            [
                'class' => ChangeLogBehavior::className(),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['status', 'weight', 'domain_id'], 'integer'],
            [['model', 'version', 'version_code', 'body_type', 'price'], 'string', 'max' => 512],
            ['locale', 'default', 'value' => Yii::$app->language],
            ['locale', 'in', 'range' => array_keys(Yii::$app->params['availableLocales'])],
//            [['published_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'             => Yii::t('common', 'ID'),
            'model' => Yii::t('common', 'Model'),
            'version'      => Yii::t('common', 'Version'),
            'version_code'       => Yii::t('common', 'Version_code'),
            'body_type'       => Yii::t('common', 'Body Type'),
            'price'       => Yii::t('common', 'Price'),
            'locale'       => Yii::t('common', 'Locale'),
            'status'         => Yii::t('common', 'Published'),
//            'published_at'   => Yii::t('common', 'Published At'),
            'created_at'     => Yii::t('common', 'Created At'),
            'updated_at'     => Yii::t('common', 'Updated At'),
            'weight'         => Yii::t('common', 'Weight'),
            'domain_id'      => Yii::t('common', 'Domain ID'),


        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
//            if (!$this->published_at) {
//                $this->published_at = $this->created_at;
//            }
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

    public function afterDelete()
    {
        $about = Price::find()->andWhere([
                'locale_group_id' => $this->locale_group_id,
                'domain_id'       => Yii::$app->user->identity->domain_id
            ])->one();

        if ($about) {
            $about->delete();
        }

        return parent::afterDelete();
    }

//    public function afterSave($insert, $changedAttributes)
//    {
//        //delete all
//        $abouts = $this->getCategories()->all();
//
//        foreach ($abouts as $about) {
//            $about->delete();
//        }
//
//        if (!empty($this->categoriesList)) {
//            //add new rows
//            foreach ($this->categoriesList as $categoryId) {
//                $about              = new AboutCategories();
//                $about->about_id    = $this->id;
//                $about->category_id = $categoryId;
//                $about->save();
//            }
//        }
//
//        return parent::afterSave($insert, $changedAttributes);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getAuthor()
//    {
//        return $this->hasOne(User::className(), ['id' => 'author_id']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getUpdater()
//    {
//        return $this->hasOne(User::className(), ['id' => 'updater_id']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getCategory()
//    {
//        return $this->hasOne(AboutCategory::className(), ['id' => 'category_id']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getFirstAboutPage()
//    {
//        return AboutPage::find()->firstAboutPage($this->id);
//        //return $this->hasOne(AboutCategory::className(), ['id' => 'category_id']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getCategories()
//    {
//        return $this->hasMany(AboutCategories::className(), ['about_id' => 'id']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getAboutAttachments()
//    {
//        return $this->hasMany(AboutAttachment::className(), ['about_id' => 'id']);
//    }

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
        $price = self::find()->orderBy("locale_group_id DESC")->one();
        if ($price) {
            return $price->locale_group_id;
        } else {
            return 0;
        }
    }

    public static function multiSave($price)
    {

        //\yii\helpers\VarDumper::dump(Yii::$app->request->post(),11,1); die();

        $defaultAttributes = [];

        foreach ($price->getModels() as $key => $v) {

            foreach ($price->getModel($key)->attributes() as $attrKey) {
                if (empty($defaultAttributes[$attrKey])) {
                    if (!empty($price->getModel($key)->$attrKey)) {
                        if ('[]' != $price->getModel($key)->$attrKey) {
                            $defaultAttributes[$attrKey] = $price->getModel($key)->$attrKey;
                        }
                    }
                }
            }
        }

        unset($defaultAttributes['id']);
        unset($defaultAttributes['locale']);
        unset($defaultAttributes['locale_group_id']);
        //unset($defaultAttributes['slug']);

        $groupId = self::getLastLocaleGroupId() + 1;

        foreach ($price->getModels() as $key => $v) {
            if (!$price->getModel($key)->locale_group_id) {
                $price->getModel($key)->locale_group_id = $groupId;
            }

            foreach ($defaultAttributes as $key2 => $value2) {
                if (empty($price->getModel($key)->$key2) or "[]" == $price->getModel($key)->$key2) {
                    $price->getModel($key)->$key2 = $value2;
                }
            }

            //\yii\helpers\VarDumper::dump($about->getModel($key),11,1);
        }


        return $price->save();
    }

    public static function getLeftMenuItems()
    {
        $items  = [];
        //['label' => Yii::t('backend', 'Models'), 'url' => ['/about/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
        $prices = self::find()
            ->published()
            ->andWhere(['locale' => Yii::$app->language])
            //->andWhere(['domain_id' => Yii::$app->user->identity->domain_id])
            ->all();

        foreach ($prices as $price) {
            $items[] = [
                'label'  => Yii::t('backend', $price->model),
                'url'    => ['/about-page/index', 'mid' => $price->id],
                'icon'   => '<i class="fa fa-angle-double-right"></i>',
                'active' => self::isActiveMenuItem($price->id, $price->locale)
            ];
        }

        return $items;
    }

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
    public function getLocaleGroupPages()
    {
        $query = new PriceQuery(get_called_class());

        return $query->localeGroupPages($this);
    }
}