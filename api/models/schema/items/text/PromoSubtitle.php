<?php

namespace api\models\schema\items\text;

use api\models\schema\base\Base;

class PromoSubtitle extends Base
{
    protected $wid    = 'promo-subtitle';
    protected $wtitle = 'Subtitle';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']['subtitle'] = [
            'type'    => 'string',
            'title'   => 'Subtitle',
            'default' => 'Lorem ipsum dolor sit amet',
        ];


        return $this->data;
    }
}