<?php

namespace api\models\schema\root\page\before_body;

use \Yii;

class Schema extends RootBase
{

    public function getData()
    {
        $this->data["title"] = "Before body";

        return $this->data;
    }
}