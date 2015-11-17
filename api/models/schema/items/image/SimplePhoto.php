<?php

namespace api\models\schema\items\image;

use api\models\schema\base\Base;
use \Yii;

class SimplePhoto extends Base
{

    public function __construct()
    {
        $this->wid    = 'simple-photo';
        $this->wtitle = Yii::t('backend', 'SimplePhoto');

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


        return $this->data;
    }
}
