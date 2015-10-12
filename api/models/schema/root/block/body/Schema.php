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
            "title"  => Yii::t('backend', 'Body'),
            "format" => "tabs",
            "items"  => [
                "title"          => Yii::t('backend', 'Widgets'),
                "id"             => "widget",
                "headerTemplate" => "{{i1}} - {{self.tab_title}}",
            ],            
        ];

        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\part\Header())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\part\Footer())->getData();

        return $this->data;
    }
}