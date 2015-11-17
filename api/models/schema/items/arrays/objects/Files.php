<?php

namespace api\models\schema\items\arrays\objects;

use api\models\schema\base\Base;
use \Yii;

class Files extends Base
{

    public function __construct()
    {
        $this->wid    = 'files';
        $this->wtitle = Yii::t('backend', 'Files');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["header_p"] = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'Заголовок 1'),
            "default" => "Заголовок 1"
        ];

        $this->data['properties']["header_2"] = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'header_2'),
            "default" => "Скачайте информацию в PDF"
        ];


        $this->data['properties']["items"] = [

            "type" => "array",
            "title"       => Yii::t('backend', 'item'),
            "uniqueItems" => true,
            "options"     => [
                "collapsed" => true
            ],
            "items"       => [
                "type"       => "object",
                "properties" => [
                    "image_src"  => [
                        "type"    => "string",
                        "format"  => "url",
                        "title"   => Yii::t('backend', 'image_min250'),
                        "options" => [
                            "upload" => true
                        ],
                        "links"   => [
                            "href" => '{{self}}',
                            "rel"  => "View file"
                        ]
                    ],
                    "alt"        => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],
                    "link_title" => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],
                    "link_href"  => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],
                ]
            ]
        ];





        return $this->data;
    }
}
