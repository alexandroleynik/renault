<?php

namespace api\models\schema\items\arrays\tables;

use api\models\schema\base\Base;
use \Yii;

class Credit extends Base
{

    public function __construct()
    {
        $this->wid    = 'credit';
        $this->wtitle = Yii::t('backend', 'Credit');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']["items"] = [

            "type" => "array",
            "title"   => Yii::t('backend', 'Credit'),
//            "uniqueItems" => true,
            "options" => [
                "collapsed" => true
            ],
            "items"   => [
                "type"        => "object",
                "title"       => Yii::t('backend', 'row'),
                "uniqueItems" => true,
                "properties"  => [
                    'items_left' => [
                        "type"       => "object",
                        "title"      => Yii::t('backend', 'Ліва таблиця'),
                        "properties" => [
                            "caption_left" => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Заголовок лівої таблиці'),
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "key_left_1"   => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Ключ 1'),
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_left_1" => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Значення 1'),
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ],
                            "key_left_2"   => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Ключ 2'),
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_left_2" => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Значення 2'),
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ],
                            "key_left_3"   => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Ключ 3'),
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_left_3" => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Значення 3'),
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ]
                        ]
                    ],
                    'items_right' => [
                        "type"       => "object",
                        "title"      => Yii::t('backend', 'Права таблиця'),
                        "properties" => [

                            "caption_right" => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Заголовок правої таблиці'),
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "key_right_1"   => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Ключ 1'),
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_right_1" => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Значення 1'),
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ],
                            "key_right_2"   => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Ключ 2'),
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_right_2" => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Значення 2'),
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ],
                            "key_right_3"   => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Ключ 3'),
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value_right_3" => [
                                "type"    => "string",
                                "title"   => Yii::t('backend', 'Значення 3'),
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