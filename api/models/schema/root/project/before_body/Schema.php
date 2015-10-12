<?php

namespace api\models\schema\root\project\before_body;

use \Yii;

use \api\models\schema\base\RootBase;

class Schema extends RootBase
{

    public function getData()
    {
        $this->data["title"] = Yii::t('backend', 'Before Body');

        return $this->data;
    }
}