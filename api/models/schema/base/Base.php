<?php
namespace api\models\schema\base;

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
                "tab_title"         => [
                    "type"     => "string",
                    "options"  => [
                        "hidden" => true
                    ],
                    "template" => "[[title]]",
                    "watch"    => [
                        "title" => "widget.___{$wid}___"
                    ]
                ],
                "___{$wid}___" => [
                    "type"    => "string",
                    "options" => [
                        "hidden" => true
                    ],
                    "default" => $wtitle
                ],
                "{$wid}-preview"      => [
                    "title"         => "Example:",
                    "type"          => "string",
                    "propertyOrder" => 10,
                    "format"        => "hidden",
                    "default"       => "/frontend/web/js/app/widgets/{$wid}/img/preview.jpg",
                    "links"         => [
                        [
                            "href"      => "[[self]]",
                            "mediaType" => "image"
                        ]
                    ]
                ],
                "t"                 => [
                    "type"        => "array",
                    "format"      => "table",
                    "title"       => "Translations",
                    "uniqueItems" => true,
                    "options"     => [
                        "collapsed" => true
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
                ]
            ]
        ];
    }

    public function getData()
    {
        return $this->data;
    }
}