<?php

namespace api\models;

use common\models\Domain;
use yii\helpers\Url;
use yii\web\Linkable;
use yii\web\Link;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Block extends \common\models\Block implements Linkable
{
    /**
     * @return array
     */
    public function fields()
    {
        return ['id', 'slug', 'title', 'description', 'body', 'domain_id', 'locale', 'locale_group_id', 'before_body', 'after_body', 'on_scenario', 'locale', 'custom'];
    }

    /**
     * @return array
     */
    public function extraFields()
    {
        return ['localeGroupPages'];
    }

    /**
     * @return array|null
     */
    public function getCustom()
    {
        if($this->slug == 'header') {
            return $this->_getHeaderCustomParams();
        }

        return null;
    }

    /**
     * @return array
     */
    private function _getHeaderCustomParams()
    {
        $result = [];
        if($this->domain_id && ($domain = Domain::findOne(['id' => $this->domain_id]))) {
            if($domain->desktopLogoUrl) {
                $result['logo_url'] = $domain->desktopLogoUrl;
            }

            if($domain->mobileLogoUrl) {
                $result['m_logo_url'] = $domain->mobileLogoUrl;
            }
        }

        return $result;
    }

    /**
     * Returns a list of links.
     *
     * @return array the links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['block/view', 'id' => $this->id], true)
        ];
    }
}