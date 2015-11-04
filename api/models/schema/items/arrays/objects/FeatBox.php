<?php

namespace api\models\schema\items\arrays\objects;

use api\models\schema\base\Base;
use \Yii;

class FeatBox extends Base
{

    public function __construct()
    {
        $this->wid    = 'feat-box';
        $this->wtitle = Yii::t('backend', 'Features');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["items"] = [

            "type" => "array",
            "title"       => Yii::t('backend', 'Add Items'),
            "uniqueItems" => true,
            "options"     => [
                "collapsed" => true
            ],
            "items"       => [
                "type"       => "object",
                "properties" => [
                    "image_src" => [
                        "type"    => "string",
                        "format"  => "url",
                        "title"   => Yii::t('backend', 'image'),
                        "options" => [
                            "upload" => true
                        ],
                        "links"   => [
                            "href" => '{{self}}',
                            "rel"  => "View file"
                        ]
                    ],
                    "alt"       => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],
                    "header"    => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],
                    "text"      => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],
                    "link_title" => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ],
                        "default" => "Узнать больше"
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