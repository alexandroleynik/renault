<?php

namespace api\models\schema\root\article\body;
use \Yii;

use \api\models\schema\base\RootBase;

class Schema extends RootBase
{

    public function getData()
    {
        $this->data["title"] = Yii::t('backend', 'Body');

        return $this->data;
    }
}