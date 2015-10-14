<?php

namespace api\models\schema\items\image;

use api\models\schema\base\Base;
use \Yii;

class Banner extends Base
{
    protected $wid = 'banner';
    protected $wtitle = 'Banner';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {


        $this->data['properties']["image"] = [

            "type" => "string",
            "format" => "url",
            "title" => Yii::t('backend', 'image'),
            "options" => [
                "upload" => true
            ],
            "links" => [
                [
                "href" => "{{self}}",
                "rel" => "View file"
                    ]
            ]

        ];

        $this->data['properties']["alt"] = [
            "type" => "string",
            "title" => Yii::t('backend', 'alt'),
            "default" => "alt"
        ];

        $this->data['properties']["href"] = [
            "type" => "string",
            "title" => Yii::t('backend', 'link'),
            "default" => "#"
        ];

        $this->data['properties']["categorie"] = [
            "type" => "string",
            "title" => Yii::t('backend', 'categorie'),
            "default" => "categorie"
        ];

        $this->data['properties']["subcategorie"] = [
            "type" => "string",
            "title" => Yii::t('backend', 'subcategorie'),
            "default" => "subcategorie"
        ];


        return $this->data;
    }
}
