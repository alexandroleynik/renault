<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;
use \Yii;

class FindADealer extends Base
{

    public function __construct()
    {
        $this->wid    = 'find-a-dealer';
        $this->wtitle = Yii::t('backend', 'Find a dealer');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']['t']['options']['hidden'] = false;
        $this->data['properties']['links']['options']['hidden'] = false;

        return $this->data;
    }
}