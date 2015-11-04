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


        return $this->data;
    }
}