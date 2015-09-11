<?php

namespace api\models\schema\items\arrays\tables;

use api\models\schema\base\Base;

class Credit extends Base
{
    protected $wid    = 'credit';
    protected $wtitle = 'Credit';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here

        $this->data['properties']["items"] = [

            "type"        => "array",
            "format"      => "table",
            "title"       => "Credit",
            "uniqueItems" => true,

            "caption_left" => [
                "type"    => "string",

                "options" => [
                    "input_width" => "300px"
                ]
            ],
            "key_left_1"   => [
                "type"    => "string",
                "options" => [
                    "input_width" => "300px"
                ]
            ],
            "value_left_1" => [
                "type"    => "string",
                "options" => [
                    "input_width" => "400px"
                ]
            ],
            "key_left_2"   => [
                "type"    => "string",
                "options" => [
                    "input_width" => "300px"
                ]
            ],
            "value_left_2" => [
                "type"    => "string",
                "options" => [
                    "input_width" => "400px"
                ]
            ],
            "key_left_3"   => [
                "type"    => "string",
                "options" => [
                    "input_width" => "300px"
                ]
            ],
            "value_left_3" => [
                "type"    => "string",
                "options" => [
                    "input_width" => "400px"
                ]
            ],
            "caption_right" => [
                "type"    => "string",
                "options" => [
                    "input_width" => "300px"
                ]
            ],
            "key_right_1"   => [
                "type"    => "string",
                "options" => [
                    "input_width" => "300px"
                ]
            ],
            "value_right_1" => [
                "type"    => "string",
                "options" => [
                    "input_width" => "400px"
                ]
            ],
            "key_right_2"   => [
                "type"    => "string",
                "options" => [
                    "input_width" => "300px"
                ]
            ],
            "value_right_2" => [
                "type"    => "string",
                "options" => [
                    "input_width" => "400px"
                ]
            ],
            "key_right_3"   => [
                "type"    => "string",
                "options" => [
                    "input_width" => "300px"
                ]
            ],
            "value_right_3" => [
                "type"    => "string",
                "options" => [
                    "input_width" => "400px"
                ]
            ]

        ];

        return $this->data;
    }
}