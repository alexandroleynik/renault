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
        return ['id', 'slug', 'category_id', 'title', 'price', 'head', 'body', 'published_at', 'thumbnail_base_url','thumbnail_path', 'domain','description'];
    }

    public function extraFields()
    {
        return ['category', 'categories', 'firstInfo'];
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