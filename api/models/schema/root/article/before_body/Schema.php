<?php

namespace api\models\schema\root\article\before_body;

use \Yii;

use \api\models\schema\base\RootBase;

class Schema extends RootBase
{

    public function getData()
    {
        $this->data["title"] = "Before body";

        return $this->data;
    }
}