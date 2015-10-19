<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;
use \Yii;

class CorporateSales extends Base
{
    protected $wid    = 'corporate-sales';
    protected $wtitle = 'Corporate Sales';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        

        return $this->data;
    }
}