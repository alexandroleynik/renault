<?php

namespace api\models\schema\root\block\body;
use \Yii;

class Schema
{
    private $data = [];

    public function getData()
    {
        $this->data = [
            "type"   => "array",
            "title"  => "Body",
            "format" => "tabs",
            "items"  => [
                "title"          => "Widgets",
                "id"             => "widget",
                "headerTemplate" => "{{i1}} - {{self.tab_title}}",
            ],            
        ];

        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\part\Header())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\part\Footer())->getData();

        return $this->data;
    }
}