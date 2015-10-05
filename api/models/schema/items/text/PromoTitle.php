<?php

namespace api\models\schema\items\text;

use api\models\schema\base\Base;

class PromoTitle extends Base
{
    protected $wid    = 'promo-title';
    protected $wtitle = 'Title';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']['title'] = [
            'type'    => 'string',
            'title'   => 'Title',
            'default' => 'Lorem ipsum dolor sit amet',
        ];


        return $this->data;
    }
}