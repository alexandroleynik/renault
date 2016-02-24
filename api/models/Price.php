<?php

namespace api\models;

use yii\helpers\Url;
use yii\web\Linkable;
use yii\web\Link;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Price extends \common\models\Price implements Linkable
{

    public function fields()
    {
        return ['id', 'model', 'version','version_code','body_type',   'price',  'domain_id',  'locale'];
    }

//    public function extraFields()
//    {
//        return ['category', 'categories', 'firstInfo', 'localeGroupPages'];
//    }

    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['price/view', 'id' => $this->id], true)
        ];
    }
}