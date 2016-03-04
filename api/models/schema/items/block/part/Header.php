<?php

namespace api\models\schema\items\block\part;

use api\models\schema\base\Base;
use \Yii;

class Header extends Base
{

    public function __construct()
    {
        $this->wid    = 'header';
        $this->wtitle = Yii::t('backend', 'Header');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties'][$this->wid . '-preview']['default'] = "/img/block_part_header_preview.jpg";

        //Show links and text fields
        $this->data['properties']['t']['options']['hidden'] = false;
        $this->data['properties']['links']['options']['hidden'] = false;

        $this->data['properties']['menu'] = [
            "type"        => "array",
            "format"      => "grid",
            "title"       => Yii::t('backend', 'Menu'),
            "uniqueItems" => true,
            "options"     => [
                "collapsed" => true
            ],
            "items"       => [
                "title"      => Yii::t('backend', 'item'),
                "type"       => "object",
                "properties" => [
                    "host"    => [
                        "type"    => "string",
                        "default" => "@frontend",
                        "options" => [
                            'grid_columns' => 4,
                            "input_width"  => "100px"
                        ]
                    ],
                    "url"     => [
                        "type"    => "string",
                        "options" => [
                            'grid_columns' => 4,
                            "input_width"  => "200px"
                        ]
                    ],
                    "title"   => [
                        "type"    => "string",
                        "options" => [
                            'grid_columns' => 4,
                            "input_width"  => "200px"
                        ]
                    ],
                    "submenu" => [
                        "type"        => "array",
                        "format"      => "table",
                        "title"       => Yii::t('backend', 'submenu'),
                        "uniqueItems" => true,
                        "options"     => [
                            'grid_columns' => 12,
                            "collapsed"    => true
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
                                ],
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->data['properties']['topmenu'] = [
            "type"        => "array",
            "format"      => "grid",
            "title"       => Yii::t('backend', 'TopMenu'),
            "uniqueItems" => true,
            "options"     => [
                "collapsed" => true
            ],
            "items"       => [
                "title"      => Yii::t('backend', 'item'),
                "maxItems" => '5',
                "type"       => "object",
                "properties" => [
                    "host"    => [
                        "type"    => "string",
                        "default" => "@frontend",
                        "options" => [
                            'grid_columns' => 4,
                            "input_width"  => "100px"
                        ]
                    ],
                    "url"     => [
                        "type"    => "string",
                        "options" => [
                            'grid_columns' => 4,
                            "input_width"  => "200px"
                        ]
                    ],
                    "title"   => [
                        "type"    => "string",
                        "options" => [
                            'grid_columns' => 4,
                            "input_width"  => "200px"
                        ]
                    ],
                    "submenu" => [
                        "type"        => "array",
                        "format"      => "table",
                        "title"       => Yii::t('backend', 'submenu'),
                        "uniqueItems" => true,
                        "options"     => [
                            'grid_columns' => 12,
                            "collapsed"    => true
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
                                ],
                            ]
                        ]
                    ]
                ]
            ]
        ];


        return $this->data;
    }
}