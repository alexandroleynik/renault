<?php

namespace api\models\schema\items\arrays\tables;

use api\models\schema\base\Base;

class DealerQB extends Base
{
    protected $wid    = 'dealer-quest-box';
    protected $wtitle = 'Dealer Quest Box';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["header"] = [

            "type" => "string",
            "title" => "header",
            "default" => "Наши дилеры рады ответить на ваши вопросы"
        ];

        $this->data['properties']["items"] = [

            "type"        => "array",
            "format"      => "table",
            "title"       => "Buttons",
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