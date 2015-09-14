<?php

namespace api\models\schema\root\info\after_body;

use \Yii;

class Schema
{
    private $data = [];

    public function getData()
    {
        $this->data = [
            "type" => "array",
            "title" => "After body",
            "format" => "tabs",
            "items" => [
                "title" => "Widgets",
                "id" => "widget",
                "headerTemplate" => "{{i1}} - {{self.tab_title}}",
            ],
        ];

        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\arrays\tables\InfoMenu())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\editor\SCEditor())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\image\Gallery())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\text\IntroText())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\text\SectionText())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\image\SimplePhoto())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\dealerquestbox\DealerQB())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\featBox\FeatBox())->getData();

        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\text\SmallText())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\bloglist\BlogListTop())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\bloglist\BlogListBottom())->getData();
        $this->data["items"]["oneOf"][] = (new \api\models\schema\items\block\files\Files())->getData();


        return $this->data;
    }
}