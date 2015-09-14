<?php

namespace common\models;

use common\models\query\ClientQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
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
 *
 * @property User $author
 * @property User $updater
 * @property ClientCategory $category
 * @property ClientAttachment[] $clientAttachments
 */
class Client extends \yii\db\ActiveRecord
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
    public $thumbnail;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%client}}';
    }

    /**
     * @return ClientQuery
     */
    public static function find()
    {
        return new ClientQuery(get_called_class());
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
                'uploadRelation' => 'clientAttachments'
            ],
            [
                'class'            => UploadBehavior::className(),
                'attribute'        => 'thumbnail',
                'pathAttribute'    => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['slug'], 'unique'],
            [['body', 'head', 'before_body', 'after_body', 'on_scenario'], 'string'],
            [['published_at'], 'default', 'value' => time()],
            [['published_at'], 'filter', 'filter' => 'strtotime'],
            [['category_id'], 'exist', 'targetClass' => ClientCategory::className(), 'targetAttribute' => 'id'],
            [['author_id', 'updater_id', 'status', 'weight', 'domain_id'], 'integer'],
            [['slug', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['title'], 'string', 'max' => 512],
            [['attachments', 'thumbnail'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('common', 'ID'),
            'slug'         => Yii::t('common', 'Slug'),
            'title'        => Yii::t('common', 'Title'),
            'head'         => Yii::t('common', 'Head'),
            'body'         => Yii::t('common', 'Body'),
            'thumbnail'    => Yii::t('common', 'Thumbnail'),
            'author_id'    => Yii::t('common', 'Author'),
            'updater_id'   => Yii::t('common', 'Updater'),
            'category_id'  => Yii::t('common', 'Category'),
            'status'       => Yii::t('common', 'Status'),
            'published_at' => Yii::t('common', 'Published At'),
            'created_at'   => Yii::t('common', 'Created At'),
            'updated_at'   => Yii::t('common', 'Updated At'),
            'weight'       => Yii::t('common', 'Weight'),
            'domain_id'    => Yii::t('common', 'Domain ID'),
            'before_body'  => Yii::t('common', 'Before body'),
            'after_body'   => Yii::t('common', 'After body'),
            'on_scenario'  => Yii::t('common', 'On scenario'),
        ];
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
        return $this->hasOne(ClientCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientAttachments()
    {
        return $this->hasMany(ClientAttachment::className(), ['client_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if (empty($this->domain_id)) {
                $this->domain_id = Yii::$app->user->identity->domain_id;
            }

            return true;
        } else {
            return false;
        }
    }
}