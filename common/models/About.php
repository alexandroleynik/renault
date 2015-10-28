<?php

namespace common\models;

use common\models\query\AboutQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use common\models\AboutCategories;
use common\behaviors\ChangeLogBehavior;
use common\models\AboutPage;

/**
 * This is the model class for table "about".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $about
 * @property string $price
 * @property string $body
 * @property string $on_scenario
 * @property string $before_body
 * @property string $after_body
 * @property string $head
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property array $attachments
 * @property integer $author_id
 * @property integer $updater_id
 * @property integer $category_id
 * @property integer $status
 * @property integer $published_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $weight
 * @property string $locale
 * @property string $domain_id
 * @property integer $locale_group_id
 *
 *
 *
 * @property User $author
 * @property User $updater
 * @property AboutCategory $category
 * @property AboutAttachment[] $aboutAttachments
 */
class About extends \yii\db\ActiveRecord
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
        return '{{%about}}';
    }

    /**
     * @return AboutQuery
     */
    public static function find()
    {
        return new AboutQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class'              => BlameableBehavior::className(),
                'createdByAttribute' => 'author_id',
                'updatedByAttribute' => 'updater_id',
            ],
            [
                'class'     => SluggableBehavior::className(),
                'attribute' => 'title',
                'immutable' => true
            ],
            [
                'class'          => UploadBehavior::className(),
                'attribute'      => 'attachments',
                'multiple'       => true,
                'uploadRelation' => 'aboutAttachments'
            ],
            [
                'class'            => UploadBehavior::className(),
                'attribute'        => 'thumbnail',
                'pathAttribute'    => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ],
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
            ['slug', 'unique', 'targetAttribute' => ['slug', 'locale', 'domain_id']],
            [['body', 'head', 'before_body', 'after_body', 'on_scenario'], 'string'],
            //[['published_at'], 'default', 'value' => time()],
            //[['published_at'], 'filter', 'filter' => 'strtotime'],
            [['category_id'], 'exist', 'targetClass' => AboutCategory::className(), 'targetAttribute' => 'id'],
            [['author_id', 'updater_id', 'status', 'weight', 'domain_id'], 'integer'],
            [['slug', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['title', 'description', 'price'], 'string', 'max' => 512],
            [['attachments', 'thumbnail', 'categoriesList', 'published_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'             => Yii::t('common', 'ID'),
            'slug'           => Yii::t('common', 'Slug'),
            'title'          => Yii::t('common', 'About'),
            'price'          => Yii::t('common', 'Price'),
            'description'    => Yii::t('common', 'Description'),
            'head'           => Yii::t('common', 'Head'),
            'body'           => Yii::t('common', 'Body'),
            'thumbnail'      => Yii::t('common', 'Thumbnail'),
            'author_id'      => Yii::t('common', 'Author'),
            'updater_id'     => Yii::t('common', 'Updater'),
            'category_id'    => Yii::t('common', 'Category'),
            'status'         => Yii::t('common', 'Published'),
            'published_at'   => Yii::t('common', 'Published At'),
            'created_at'     => Yii::t('common', 'Created At'),
            'updated_at'     => Yii::t('common', 'Updated At'),
            'weight'         => Yii::t('common', 'Weight'),
            'categoriesList' => Yii::t('common', 'Categories list'),
            'domain_id'      => Yii::t('common', 'Domain ID'),
            'before_body'    => Yii::t('common', 'Before body'),
            'after_body'     => Yii::t('common', 'After body'),
            'on_scenario'    => Yii::t('common', 'On scenario'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!$this->published_at) {
                $this->published_at = $this->created_at;
            }
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
        $about = About::find()->andWhere([
                'locale_group_id' => $this->locale_group_id,
                'domain_id'       => Yii::$app->user->identity->domain_id
            ])->one();

        if ($about) {
            $about->delete();
        }

        return parent::afterDelete();
    }

    public function afterSave($insert, $changedAttributes)
    {
        //delete all
        $abouts = $this->getCategories()->all();

        foreach ($abouts as $about) {
            $about->delete();
        }

        if (!empty($this->categoriesList)) {
            //add new rows
            foreach ($this->categoriesList as $categoryId) {
                $about              = new AboutCategories();
                $about->about_id    = $this->id;
                $about->category_id = $categoryId;
                $about->save();
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updater_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(AboutCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirstAboutPage()
    {
        return AboutPage::find()->firstAboutPage($this->id);
        //return $this->hasOne(AboutCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(AboutCategories::className(), ['about_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAboutAttachments()
    {
        return $this->hasMany(AboutAttachment::className(), ['about_id' => 'id']);
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

    public static function getLastLocaleGroupId()
    {
        $about = self::find()->orderBy("locale_group_id DESC")->one();
        if ($about) {
            return $about->locale_group_id;
        } else {
            return 0;
        }
    }

    public static function multiSave($about)
    {

        //\yii\helpers\VarDumper::dump(Yii::$app->request->post(),11,1); die();

        $defaultAttributes = [];

        foreach ($about->getModels() as $key => $v) {

            foreach ($about->getModel($key)->attributes() as $attrKey) {
                if (empty($defaultAttributes[$attrKey])) {
                    if (!empty($about->getModel($key)->$attrKey)) {
                        if ('[]' != $about->getModel($key)->$attrKey) {
                            $defaultAttributes[$attrKey] = $about->getModel($key)->$attrKey;
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

        foreach ($about->getModels() as $key => $v) {
            if (!$about->getModel($key)->locale_group_id) {
                $about->getModel($key)->locale_group_id = $groupId;
            }

            foreach ($defaultAttributes as $key2 => $value2) {
                if (empty($about->getModel($key)->$key2) or "[]" == $about->getModel($key)->$key2) {
                    $about->getModel($key)->$key2 = $value2;
                }
            }

            //\yii\helpers\VarDumper::dump($about->getModel($key),11,1);
        }


        return $about->save();
    }

    public static function getLeftMenuItems()
    {
        $items  = [];
        //['label' => Yii::t('backend', 'Models'), 'url' => ['/about/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
        $abouts = self::find()
            ->published()
            ->andWhere(['locale' => Yii::$app->language])
            ->andWhere(['domain_id' => Yii::$app->user->identity->domain_id])
            ->all();

        foreach ($abouts as $about) {
            $items[] = [
                'label'  => Yii::t('backend', $about->title),
                'url'    => ['/about-page/index', 'mid' => $about->id],
                'icon'   => '<i class="fa fa-angle-double-right"></i>',
                'active' => self::isActiveMenuItem($about->id, $about->locale)
            ];
        }

        return $items;
    }

    private static function isActiveMenuItem($mid, $locale)
    {
        $result = false;

        if (preg_match('/^about-page/', Yii::$app->request->pathinfo)) {
            if ($mid == Yii::$app->request->get('mid')) {
                $result = true;
            }
        }

        if (preg_match('/^about-page\/update/', Yii::$app->request->pathinfo)) {
            if (Yii::$app->request->get('id')) {
                $model           = AboutPage::findOne(['id' => Yii::$app->request->get('id')]);
                $localGroupModel = AboutPage::findOne(['locale_group_id' => $model->locale_group_id, 'locale' => $locale]);

                if ($model and $mid == $model->about_id) {
                    $result = true;
                }
            }
        }

        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocaleGroupPages()
    {
        $query = new AboutQuery(get_called_class());

        return $query->localeGroupPages($this);
    }
}