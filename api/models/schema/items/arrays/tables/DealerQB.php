<?php

namespace api\models\schema\items\arrays\tables;

use api\models\schema\base\Base;
use \Yii;

class DealerQB extends Base
{

    public function __construct()
    {
        $this->wid    = 'dealer-quest-box';
        $this->wtitle = Yii::t('backend', 'Dealer Quest Box');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["header"] = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'header'),
            "default" => "Наши дилеры рады ответить на ваши вопросы"
        ];

        $this->data['properties']["items"] = [

            "type"        => "array",
            "format"      => "table",
            "title"       => Yii::t('backend', 'Buttons'),
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