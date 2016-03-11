<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 3:17 PM
 */

namespace api\models\schema\items\block;

use api\models\schema\base\Base;
use \Yii;

class Social extends Base
{

    public function __construct()
    {
        $this->wid    = 'social';
        $this->wtitle = Yii::t('backend', 'Social');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']['title']          = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Title'),
            'default' => 'RENAULT В СОЦИАЛЬНЫХ СЕТЯХ',
        ];
          $this->data['properties']['vk_visible']          = [
              "type"=> "boolean",
            "format"=> "checkbox",
            'title'   => Yii::t('backend', 'YouTube is visible'),
            'default' => 'true',
        ];
   $this->data['properties']['fb_visible']          = [
              "type"=> "boolean",
            "format"=> "checkbox",
            'title'   => Yii::t('backend', 'Facebook is visible'),
            'default' => 'true',
        ];
   $this->data['properties']['inst_visible']          = [
            "type"=> "boolean",
            "format"=> "checkbox",
            'title'   => Yii::t('backend', 'Instagram is visible'),
            'default' => 'true',
        ];

        $this->data['properties']['FbTitle']        = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Facebook Title'),
            'default' => 'Renault Украина',
        ];
        $this->data['properties']['FbPageName']     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Facebook page'),
            'default' => 'renault.ua',
        ];
        $this->data['properties']['YtTitle']        = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Youtube Title'),
            'default' => 'Renault Украина',
        ];
        $this->data['properties']['YtChannelName']  = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'youtube channel name'),
            'default' => 'renaultua',
        ];
        $this->data['properties']['YtChannelId']  = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'youtube channel id'),
            'default' => 'UCKDogp5MchjxMrJRr4EBWbA',
        ];
        $this->data['properties']['instTitle']      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Instagram Title'),
            'default' => 'Renault Украина Instagram',
        ];
        $this->data['properties']['instUserId']     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Instagram user id'),
            'default' => '2088219317',
        ];
        $this->data['properties']['load_more_text'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Title'),
            'default' => 'ЗАВАНТАЖИТИ БІЛЬШЕ',
        ];
        $this->data['properties']['wordSlice']      = [
            'type'    => 'number',
            'title'   => Yii::t('backend', 'slice message (number of words)'),
            'default' => '20',
        ];


        return $this->data;
    }
}