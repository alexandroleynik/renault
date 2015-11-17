<?php

namespace api\models\schema\items\image;

use api\models\schema\base\Base;
use \Yii;

class Banner extends Base
{

    public function __construct()
    {
        $this->wid    = 'banner';
        $this->wtitle = Yii::t('backend', 'Banner');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {


        $this->data['properties']["image"] = [

            "type"    => "string",
            "format"  => "url",
            "title"   => Yii::t('backend', 'image_min_1170'),
            "options" => [
                "upload" => true
            ],
            "links"   => [
                [
                    "href" => "{{self}}",
                    "rel"  => "View file"
                ]
            ]
        ];

        $this->data['properties']["alt"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'alt'),
            "default" => "alt"
        ];

        $this->data['properties']["href"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'link'),
            "default" => "#"
        ];

        $this->data['properties']["categorie"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'categorie'),
            "default" => "categorie"
        ];

        $this->data['properties']["subcategorie"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'subcategorie'),
            "default" => "subcategorie"
        ];


        return $this->data;
    }
}
