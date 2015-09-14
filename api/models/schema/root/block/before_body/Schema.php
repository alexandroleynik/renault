<?php

namespace api\models\schema\root\block\before_body;

use \Yii;

class Schema
{
    private $data = [];

    public function getData()
    {
        $this->data = [
            "type"   => "array",
            "title"  => "Before body",
            "format" => "tabs",
            "items"  => [
                "title"          => "Widgets",
                "id"             => "widget",
                "headerTemplate" => "{{i1}} - {{self.tab_title}}",
            ],
        ];
        
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\editor\SCEditor())->getData();

        return $this->data;
    }
}