<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;
use \Yii;

class FindADealer extends Base
{
    protected $wid    = 'find-a-dealer';
    protected $wtitle = 'Find a dealer';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        

        return $this->data;
    }
}