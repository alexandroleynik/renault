<?php

namespace api\models\schema\items\video;

use api\models\schema\base\Base;
use \Yii;

class Video extends Base
{

    public function __construct()
    {
        $this->wid    = 'video';
        $this->wtitle = Yii::t('backend', 'Video');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["image"] = [

            "type"    => "string",
            "format"  => "url",
            "title"   => Yii::t('backend', 'preview1170'),
            "options" => [
                "upload" => true
            ],
            "links"   => [
                "href" => "{{self}}",
                "rel"  => "View file"
            ]
        ];

        $this->data['properties']["alt"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'alt'),
            "default" => "alt"
        ];

        $this->data['properties']["embed-example"] = [
            "title"   => Yii::t('backend', 'Embed Example:'),
            "type"    => "string",
//            "propertyOrder" => 10,
            "format"  => "hidden",
            "default" => "/frontend/web/img/embed-example.png",
            "links"   => [
                [
                    "href"      => "{{self}}",
                    "mediaType" => "image"
                ]
            ],
        ];
        $this->data['properties']["embed"]         = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'embed відео'),
            "default" => "CyDuGv_1GDY"
        ];


        $this->data['properties']["text"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'Підпис'),
            "default" => "Новый Renault LOGAN"
        ];


        return $this->data;
    }
}
