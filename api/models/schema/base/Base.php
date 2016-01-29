<?php

namespace api\models\schema\base;

use \Yii;

/**
 * Description of Base
 *
 * @author Eugene Fabrikov <eugene.fabrikov@gmail.com>
 */
class Base
{
    protected $wid;
    protected $wtitle;
    protected $data;

    public function __construct($wid, $wtitle)
    {
        $this->data = [
            "type"       => "object",
            "title"      => $wtitle,
            "properties" => [
                "tab_title"      => [
                    "type"     => "string",
                    "options"  => [
                        "hidden" => true
                    ],
                    "template" => "{{title}}",
                    "watch"    => [
                        "title" => "widget.___{$wid}___"
                    ]
                ],
                "___{$wid}___"   => [
                    "type"    => "string",
                    "options" => [
                        "hidden" => true
                    ],
                    "default" => $wtitle
                ],
                "{$wid}-preview" => [
                    "title"         => Yii::t('backend', 'Example:'),
                    "type"          => "string",
                    "propertyOrder" => 10,
                    "format"        => "hidden",
                    "default"       => Yii::getAlias('@frontendUrl') . "/img/widget_preview/{$wid}.jpg",
                    "links"         => [
                        [
                            "href"      => "{{self}}",
                            "mediaType" => "image"
                        ]
                    ]
                ],
                "t"              => [
                    "type"        => "array",
                    "format"      => "table",
                    "title"       => Yii::t('backend', 'Text fields'),
                    "uniqueItems" => true,
                    "options"     => [
                        "collapsed" => true,
                        "hidden" => YII_ENV_PROD
                    ],
                    "items"       => [
                        "type"       => "object",
                        "properties" => [
                            "key"   => [
                                "type"    => "string",
                                "options" => [
                                    "input_width" => "300px"
                                ]
                            ],
                            "value" => [
                                "type"    => "string",
                                "options" => [
                                    "input_width" => "400px"
                                ]
                            ]
                        ]
                    ]
                ],
                'links'           => [
                    "type"        => "array",
                    "format"      => "table",
                    "title"       => Yii::t('backend', 'Link fields'),
                    "uniqueItems" => true,
                    "options"     => [
                        "collapsed" => true,
                        "hidden" => YII_ENV_PROD
                    ],
                    "items"       => [
                        "type"       => "object",
                        "properties" => [
                            "key"  => [
                                "type"    => "string",
                                "options" => [
                                    "input_width" => "100px"
                                ]
                            ],
                            "host"  => [
                                "type"    => "string",
                                "default" => "@frontend",
                                "options" => [
                                    "input_width" => "200px"
                                ]
                            ],
                            "url"   => [
                                "type"    => "string",
                                "options" => [
                                    "input_width" => "200px"
                                ]
                            ]                            
                        ]
                    ]
                ],
                "anchor" => [
                    "type"    => "string",
                    "title"   => Yii::t('backend', 'Anchor'),
                    "default" => "anchor"
                ],
            ]
        ];
    }

    public function getData()
    {
        return $this->data;
    }
}
