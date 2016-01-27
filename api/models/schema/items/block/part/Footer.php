<?php

namespace api\models\schema\items\block\part;

use api\models\schema\base\Base;
use \Yii;

class Footer extends Base
{

    public function __construct()
    {
        $this->wid    = 'footer';
        $this->wtitle = Yii::t('backend', 'Footer');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties'][$this->wid . '-preview']['default'] = "/img/block_part_footer_preview.jpg";

        //Show links and text fields
        $this->data['properties']['t']['options']['hidden'] = false;
        $this->data['properties']['links']['options']['hidden'] = false;

        $this->data['properties']['menu'] = [
            "type"        => "array",
            "format"      => "table",
            "title"       => Yii::t('backend', 'Left menu'),
            "uniqueItems" => true,
            "options"     => [
                "collapsed" => true
            ],
            "items"       => [
                "type"       => "object",
                "properties" => [
                    "host"  => [
                        "type"    => "string",
                        "default" => "@frontend",
                        "options" => [
                            "input_width" => "100px"
                        ]
                    ],
                    "url"   => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "200px"
                        ]
                    ],
                    "title" => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "200px"
                        ]
                    ]
                ]
            ]
        ];

        return $this->data;
    }
}