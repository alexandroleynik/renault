<?php

namespace api\models\schema\root\about\after_body;

use \Yii;

use \api\models\schema\base\RootBase;

class Schema extends RootBase
{

    public function getData()
    {
        $this->data["title"] = "After body";

        return $this->data;
    }
}