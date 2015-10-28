<?php

namespace api\models;

use yii\helpers\Url;
use yii\web\Linkable;
use yii\web\Link;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Model extends \common\models\Model implements Linkable
{

    public function fields()
    {
        return ['id', 'slug', 'category_id', 'title', 'price', 'head', 'body', 'published_at', 'thumbnail_base_url', 'thumbnail_path', 'domain_id', 'description', 'before_body', 'after_body', 'on_scenario', 'locale'];
    }

    public function extraFields()
    {
        return ['category', 'categories', 'firstInfo', 'localeGroupPages'];
    }

    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['model/view', 'id' => $this->id], true)
        ];
    }
}