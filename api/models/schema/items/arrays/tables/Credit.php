<?php

namespace api\models\schema\items\arrays\tables;

use api\models\schema\base\Base;

class Credit extends Base
{
    protected $wid = 'credit';
    protected $wtitle = 'Credit';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']["items"] = [

            "type" => "array",

            "title" => "Credit",
//            "uniqueItems" => true,
            "options" => [
                "collapsed" => true
            ],
            "items" => [
                "type" => "object",
                "title" => "row",
                "uniqueItems" => true,
                "properties" => [
                    'items_left' => [
                        "type" => "object",
                        "title" => "Ліва таблиця",
                        "properties" => [
                            "caption_left" => [
                                "type" => "string",
                                "title" => "Заголовок лівої таблиці",
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "key_left_1" => [
                                "type" => "string",
                                "title" => "Ключ 1",
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_left_1" => [
                                "type" => "string",
                                "title" => "Значення 1",
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ],
                            "key_left_2" => [
                                "type" => "string",
                                "title" => "Ключ 2",
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_left_2" => [
                                "type" => "string",
                                "title" => "Значення 2",
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ],
                            "key_left_3" => [
                                "type" => "string",
                                "title" => "Ключ 3",
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_left_3" => [
                                "type" => "string",
                                "title" => "Значення 3",
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ]
                        ]
                    ],


                    'items_right' => [
                        "type" => "object",
                        "title" => "Права таблиця",
                        "properties" => [

                            "caption_right" => [
                                "type" => "string",
                                "title" => "Заголовок правої таблиці",
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "key_right_1" => [
                                "type" => "string",
                                "title" => "Ключ 1",
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_right_1" => [
                                "type" => "string",
                                "title" => "Значення 1",
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ],
                            "key_right_2" => [
                                "type" => "string",
                                "title" => "Ключ 2",
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_right_2" => [
                                "type" => "string",
                                "title" => "Значення 2",
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ],
                            "key_right_3" => [
                                "type" => "string",
                                "title" => "Ключ 3",
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_right_3" => [
                                "type" => "string",
                                "title" => "Значення 3",
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ]
                        ]
                    ]
                ]]

        ];

//        $this->data['properties']["items"] = [
//
//            "type"        => "array",
//            "title"       => "Credit",
//            "uniqueItems" => true,
//            "options"     => [
//                "collapsed" => true
//            ],
//            "items"       => [
//                "type"       => "object",
//                "properties" => [

//            ]]]
//
//        ];

        return $this->data;
    }
}