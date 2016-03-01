<?php

namespace common\models;

use common\models\query\FinanceQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use common\models\FinanceCategories;
use common\behaviors\ChangeLogBehavior;
use common\models\FinancePage;

/**
 * This is the model class for table "finance".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $finance
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
 * @property FinanceCategory $category
 * @property FinanceAttachment[] $financeAttachments
 */
class Finance extends \yii\db\ActiveRecord
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
        return '{{%finance}}';
    }

    /**
     * @return FinanceQuery
     */
    public static function find()
    {
        return new FinanceQuery(get_called_class());
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
                'uploadRelation' => 'financeAttachments'
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
            [['category_id'], 'exist', 'targetClass' => FinanceCategory::className(), 'targetAttribute' => 'id'],
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
            'title'          => Yii::t('common', 'Finance'),
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
        $finance = Finance::find()->andWhere([
                'locale_group_id' => $this->locale_group_id,
                'domain_id'       => Yii::$app->user->identity->domain_id
            ])->one();

        if ($finance) {
            $finance->delete();
        }

        return parent::afterDelete();
    }

    public function afterSave($insert, $changedAttributes)
    {
        //delete all
        $finances = $this->getCategories()->all();

        foreach ($finances as $finance) {
            $finance->delete();
        }

        if (!empty($this->categoriesList)) {
            //add new rows
            foreach ($this->categoriesList as $categoryId) {
                $finance              = new FinanceCategories();
                $finance->finance_id    = $this->id;
                $finance->category_id = $categoryId;
                $finance->save();
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
        return $this->hasOne(FinanceCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirstFinancePage()
    {
        return FinancePage::find()->firstFinancePage($this->id);
        //return $this->hasOne(FinanceCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(FinanceCategories::className(), ['finance_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinanceAttachments()
    {
        return $this->hasMany(FinanceAttachment::className(), ['finance_id' => 'id']);
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
        $finance = self::find()->orderBy("locale_group_id DESC")->one();
        if ($finance) {
            return $finance->locale_group_id;
        } else {
            return 0;
        }
    }

    public static function multiSave($finance)
    {

        //\yii\helpers\VarDumper::dump(Yii::$app->request->post(),11,1); die();

        $defaultAttributes = [];

        foreach ($finance->getModels() as $key => $v) {

            foreach ($finance->getModel($key)->attributes() as $attrKey) {
                if (empty($defaultAttributes[$attrKey])) {
                    if (!empty($finance->getModel($key)->$attrKey)) {
                        if ('[]' != $finance->getModel($key)->$attrKey) {
                            $defaultAttributes[$attrKey] = $finance->getModel($key)->$attrKey;
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

        foreach ($finance->getModels() as $key => $v) {
            if (!$finance->getModel($key)->locale_group_id) {
                $finance->getModel($key)->locale_group_id = $groupId;
            }

            foreach ($defaultAttributes as $key2 => $value2) {
                if (empty($finance->getModel($key)->$key2) or "[]" == $finance->getModel($key)->$key2) {
                    $finance->getModel($key)->$key2 = $value2;
                }
            }

            //\yii\helpers\VarDumper::dump($finance->getModel($key),11,1);
        }


        return $finance->save();
    }

    public static function getLeftMenuItems()
    {
        $items  = [];
        //['label' => Yii::t('backend', 'Models'), 'url' => ['/finance/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
        $finances = self::find()
            ->published()
            ->andWhere(['locale' => Yii::$app->language])
            //->andWhere(['domain_id' => Yii::$app->user->identity->domain_id])
            ->all();

        foreach ($finances as $finance) {
            $items[] = [
                'label'  => Yii::t('backend', $finance->title),
                'url'    => ['/finance-page/index'],
                'icon'   => '<i class="fa fa-angle-double-right"></i>',
                'active' => self::isActiveMenuItem($finance->id, $finance->locale)
            ];
        }

        return $items;
    }

    private static function isActiveMenuItem($mid, $locale)
    {
        $result = false;

        if (preg_match('/^finance-page/', Yii::$app->request->pathinfo)) {
            if ($mid == Yii::$app->request->get('mid')) {
                $result = true;
            }
        }

        if (preg_match('/^finance-page\/update/', Yii::$app->request->pathinfo)) {
            if (Yii::$app->request->get('id')) {
                $model           = FinancePage::findOne(['id' => Yii::$app->request->get('id')]);
                $localGroupModel = FinancePage::findOne(['locale_group_id' => $model->locale_group_id, 'locale' => $locale]);

                if ($model and $mid == $model->finance_id) {
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
        $query = new FinanceQuery(get_called_class());

        return $query->localeGroupPages($this);
    }
}