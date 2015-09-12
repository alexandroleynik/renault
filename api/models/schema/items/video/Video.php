<?php

namespace api\models\schema\items\video;

use api\models\schema\base\Base;

class Video extends Base
{
    protected $wid = 'video';
    protected $wtitle = 'Video';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["image"] = [

            "type" => "string",
            "format" => "url",
            "title" => "Прев’ю",
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
        $this->data['properties']["embed"] = [

            "type" => "string",
            "title" => "embed відео",
            "default" => "CyDuGv_1GDY"
        ];

        $this->data['properties']["text"] = [
            "type" => "string",
            "title" => "Підпис",
            "default" => "Новый Renault LOGAN"
        ];


        return $this->data;
    }
}
