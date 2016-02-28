<?php

namespace common\models;

use common\models\query\PriceQuery;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use common\components\excell\ImportBehavior;
use common\behaviors\ChangeLogBehavior;
use common\base\MultiModel;

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
    public $on_scenario;

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
            ImportBehavior::className(),
            [
                'class' => ChangeLogBehavior::className(),
            ]
        ];
    }

    public function onImportRow($row, $index, $max_row) {
//        \yii\helpers\VarDumper::dump($row);
        $this->addLog( implode(' / ', $row) );

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentModel         = Price::getLocaleInstance($key);
            $currentModel->locale = $key;

            if (Yii::$app->request->get('scenario')) {
                $currentModel->on_scenario = Yii::$app->request->get('scenario');
            }

            $models[$key] = $currentModel;
        }

        //set data from default model
//        if (Yii::$app->request->get('locale_group_id')) {
//
//            $defaultDomainModels = Price::find()
//                ->andFilterWhere([
//                    'domain_id'       => Yii::getAlias('@defaultDomainId'),
//                    'locale_group_id' => Yii::$app->request->get('locale_group_id')
//                ])
//                ->all();
//
//            foreach ($defaultDomainModels as $key => $value) {
//                if (!in_array(
//                    $value->locale, array_keys(
//                        Yii::$app->params['availableLocales']
//                    )
//                )
//                ) {
//                    continue;
//                };
//
//                $models[$value->locale]->model        = $row[0];
//                $models[$value->locale]->version        = $row[1];
//                $models[$value->locale]->version_code       = $row[2];
//                $models[$value->locale]->body_type        = $row[3];
//                $models[$value->locale]->price       = $row[4];
//                $arr = ['PriceUkUA' => [
//                    'model' => $row[0],
//                    'version' => $row[1],
//                    'version_code' => $row[2],
//                    'body_type' => $row[3],
//                    'price' => $row[4],
//                    'weight' => '',
//                    'status' => '1',
//                ],
//                    'PriceRuRU' => [
//                        'model' => '',
//                        'version' => '',
//                        'version_code' => '',
//                        'body_type' => '',
//                        'price' => '',
//                        'weight' => '',
//                        'status' => '0',
//                    ]];
//            }
//        }

        $model = new MultiModel(['models' => $models
        ]);
        $arr = ['PriceUkUA' => [
            'model' => $row[0],
            'version' => $row[1],
            'version_code' => $row[2],
            'body_type' => $row[3],
            'price' => $row[4],
            'weight' => '',
            'status' => '1',
        ],
            'PriceRuRU' => [
                'model' => '',
                'version' => '',
                'version_code' => '',
                'body_type' => '',
                'price' => '',
                'weight' => '',
                'status' => '0',
            ]];
//        \yii\helpers\VarDumper::dump($arr, 11,1); die();
        if ($model->load($arr) && Price::multiSave($model)) {
//            return $this->redirect(['index']);
        } else {
//            switch (Yii::$app->request->get('scenario')) {
//                case 'extend' :
//                    $viewName = 'extend';
//                    break;
//                default :
//                    $viewName = 'create';
//            }
//            return $this->render($viewName, [
//                'model'      => $model,
//
//                'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
//            ]);
        }
        return true; // return FALSE to stop import
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

    /**
     * @return array
     */
    public static function getAllVersionCodes()
    {
        $codes = [];

        $prices = self::find()
            ->published()
            ->forDomain()
            ->andWhere(['locale' => Yii::$app->language])
            ->all();

        foreach ($prices as $price) {
            $codes[] = ($price->model . ' - ' . $price->version_code);
        }

        return $codes;
    }
}