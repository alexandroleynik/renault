<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;

class News extends Base
{
    protected $wid    = 'block/page/news';
    protected $wtitle = 'News block';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']["order_by"] = [
            "type"          => "string",
            "propertyOrder" => 16,
            "title"         => "Order by filed.",
            "enum"          => [
                "id",
                "weight",
                "created_at",
                "updated_at"
            ],
            "options"       => [
                "enum_titles" => ["Id", "Weight", "Created at", "Updated at"]
            ],
            "default"       => "id"
        ];

        $this->data['properties']["sort_order"] = [
            "type"          => "string",
            "propertyOrder" => 17,
            "title"         => "Sort order.",
            "enum"          => [
                "asc",
                "desc"
            ],
            "options"       => [
                "enum_titles" => ["asc", "desc"]
            ],
            "default"       => "desc"
        ];

        $this->data['properties']["count"] = [
            "type"          => "string",
            "propertyOrder" => 18,
            "title"         => "News count.",
            "default"       => "20"
        ];

        return $this->data;
    }
}