<?php

namespace api\models\schema\items\arrays\tables;

use api\models\schema\base\Base;
use \Yii;

class InfoMenu extends Base
{

    public function __construct()
    {
        $this->wid    = 'info-menu';
        $this->wtitle = Yii::t('backend', 'Menu');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']['t']["options"]["hidden"] = false;
        $this->data['properties']['links']["options"]["hidden"] = false;

        $this->data['properties']["items"] = [

            "type"        => "array",
            "format"      => "table",
            "title"       => Yii::t('backend', 'Menu'),
            "uniqueItems" => true,
            "options"     => [
                "collapsed" => true
            ],
            "items"       => [
                "title"      => Yii::t('backend', 'item'),
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
                            "input_width" => "300px"
                        ]
                    ],
                    "title" => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ]
                ]
            ]
        ];

        return $this->data;
    }
}