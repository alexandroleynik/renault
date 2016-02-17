<?php

namespace common\models\sitemaps;

use common\models\Article as ArticleModels;
use common\models\query\ArticleQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use common\models\ArticleCategories;
use common\behaviors\ChangeLogBehavior;

/**
 * This is the model class for table "article".
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
 * @property string $locale
 * @property string $domain_id
 * @property integer $last_group_id
 *
 *
 *
 * @property User $author
 * @property User $updater
 * @property ArticleCategory $category
 * @property ArticleAttachment[] $articleAttachments
 */
class Article extends ArticleModels
{

    /**
     * @var array
     */
    public $attachments;



    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        return [
            'sitemap'     => [
                'class' => \himiklab\sitemap\behaviors\SitemapBehavior::className(),
                'scope' => function ($model) {
                    // @var \yii\db\ActiveQuery $model
                    $model->select(['slug', 'updated_at']);
                    $model->andWhere(['status' => 1]);
                    $model->andWhere(['locale' => 'uk-UA']);
                },
                'dataClosure' => function ($model) {
                    // @var self $model
                    return
                        [
                            'loc'        => \yii\helpers\Url::to('uk/article/' . $model->slug, true),
                            'lastmod'    => $model->updated_at,
                            'changefreq' => \himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                            'priority'   => 0.8
                        ];
                }

            ]

        ];
    }

    /**
     * @inheritdoc
     */

}