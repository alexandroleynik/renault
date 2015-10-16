<?php

namespace api\models\schema\root\finance\after_body;

use \Yii;

use \api\models\schema\base\RootBase;

class Schema extends RootBase
{

    public function getData()
    {
        $this->data["title"] = Yii::t('backend', 'After body');

        return $this->data;
    }
}