<?php

namespace api\models\schema\items\image;

use api\models\schema\base\Base;

class SimplePhoto extends Base
{
    protected $wid = 'simple-photo';
    protected $wtitle = 'SimplePhoto';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {


        $this->data['properties']["image"] = [

            "type" => "string",
            "format" => "url",
            "title" => "simple photo",
            "options" => [
                "upload" => true
            ],
            "links" => [
                "href" => "{{self}}",
                "rel" => "View file"
            ]

        ];

        $this->data['properties']["alt"] = [
            "type" => "string",
            "title" => "alt",
            "default" => "alt"
        ];


        return $this->data;
    }
}
