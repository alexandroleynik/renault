<?php

namespace api\models\schema\root\service\before_body;

use \Yii;

class Schema extends RootBase
{

    public function getData()
    {
        $this->data["title"] = "Before body";

        return $this->data;
    }
}