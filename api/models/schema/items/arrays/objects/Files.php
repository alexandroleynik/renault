<?php

namespace api\models\schema\items\arrays\objects;

use api\models\schema\base\Base;

class Files extends Base
{
    protected $wid    = 'files';
    protected $wtitle = 'Files';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["header_p"] = [

            "type" => "string",
            "title" => "Заголовок 1",
            "default" => "Заголовок 1"
        ];

        $this->data['properties']["header_2"] = [

            "type" => "string",
            "title" => "header_2",
            "default" => "Скачайте информацию в PDF"
        ];


        $this->data['properties']["items"] = [

            "type"        => "array",

            "title"       => "item",
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
                    "link_title" => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
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