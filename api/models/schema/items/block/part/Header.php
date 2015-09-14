<?php

namespace api\models\schema\items\block\part;

use api\models\schema\base\Base;

class Header extends Base
{
    protected $wid    = 'header';
    protected $wtitle = 'Header';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties'][$this->wid . '-preview']['default'] = "/img/block_part_header_preview.jpg";

        $this->data['properties']['menu'] = [
            "type"        => "array",
            "format"      => "table",
            "title"       => "Menu",
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
                            "input_width" => "200px"
                        ]
                    ],
                    "title" => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "200px"
                        ]
                    ]
                ]
            ]
        ];

        return $this->data;
    }
}