<?php

namespace api\models\schema\root\service\head;

use \Yii;
use api\models\schema\base\HeadBase;

class Schema extends HeadBase
{
    public function getData()
    {
        //custom code here

        return $this->data;
    }
}