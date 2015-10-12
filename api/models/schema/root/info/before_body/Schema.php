<?php

namespace api\models\schema\root\info\before_body;

use \Yii;

use \api\models\schema\base\RootBase;

class Schema extends RootBase
{

    public function getData()
    {
        $this->data["title"] = Yii::t('backend', 'Before body');

        return $this->data;
    }
}