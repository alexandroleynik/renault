<?php

namespace api\models\schema\items\arrays\tables;

use api\models\schema\base\Base;
use \Yii;

class InfoMenu extends Base
{
    protected $wid = 'info-menu';
    protected $wtitle = 'Menu';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']["items"] = [

            "type" => "array",
            "format" => "table",
            "title" => Yii::t('backend', 'Menu'),
            "uniqueItems" => true,
            "options" => [
                "collapsed" => true
            ],
            "items" => [
                "type" => "object",
                "properties" => [
                    "host" => [
                        "type" => "string",
                        "default" => "@frontend",
                        "options" => [
                            "input_width" => "100px"
                        ]
                    ],
                    "url" => [
                        "type" => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],
                    "title" => [
                        "type" => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],
                    'submenu' => [
                        "type" => "array",
                        "format" => "table",
                        "title" => Yii::t('backend', 'submenu'),
                        "uniqueItems" => true,
                        "options" => [
                            "collapsed" => true
                        ],
                        "items" => [
                            "type" => "object",
                            "options" => [
                                "upload" => true,
                                'grid_columns' => 12,
                                "input_width" => "300px"
                            ],
                            "properties" => [
                                "host" => [
                                    "type" => "string",
                                    "default" => "@frontend",
                                    "options" => [
                                        "input_width" => "100px"
                                    ]
                                ],
                                "url" => [
                                    "type" => "string",
                                    "options" => [
                                        "input_width" => "300px"
                                    ]
                                ],
                                "title" => [
                                    "type" => "string",
                                    "options" => [
                                        "input_width" => "300px"
                                    ]
                                ]
                            ]

                        ]
                    ]
                ],

            ]
        ];

        return $this->data;
    }
}