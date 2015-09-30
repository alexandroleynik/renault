<?php

namespace api\models;

use yii\helpers\Url;
use yii\web\Linkable;
use yii\web\Link;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class AboutCategory extends \common\models\AboutCategory implements Linkable
{

    public function fields()
    {
        return ['id', 'slug', 'title', 'weight', 'domain_id'];
    }

    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['api/v1/about-category/view', 'id' => $this->id], true)
        ];
    }
}