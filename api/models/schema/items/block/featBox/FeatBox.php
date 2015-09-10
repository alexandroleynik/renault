<?php

namespace api\models\schema\items\block\featBox;

use api\models\schema\base\Base;

class FeatBox extends Base
{
    protected $wid    = 'feat-box';
    protected $wtitle = 'Feat Box';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["items"] = [

            "type"        => "array",

            "title"       => "Add Items",
            "uniqueItems" => true,
            "options"     => [
                "collapsed" => true
            ],
            "items"       => [
                "type"       => "object",
                "properties" => [
                    "image_src"  => [
                        "type" => "string",
                        "format" => "url",
                        "title" => "image",
                        "options" => [
                            "upload" => true
                        ],
                        "links" => [
                            "href" => '{{self}}',
                            "rel" => "View file"
                        ]
                    ],
                    "alt"   => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],
                    "header"   => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],
                     "text"   => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],

                    "link_title" => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ],
                        "default" => "Узнать больше"
                    ],
                    "link_href" => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ],
                ]
            ]
        ];





        return $this->data;
    }
}