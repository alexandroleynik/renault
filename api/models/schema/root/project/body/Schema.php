<?php

namespace api\models\schema\root\project\body;
use \Yii;

use \api\models\schema\base\RootBase;

class Schema extends RootBase
{

    public function getData()
    {
        $this->data["title"] = "Body";

        return $this->data;
    }
}