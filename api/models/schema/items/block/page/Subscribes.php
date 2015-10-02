<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;

class Subscribes extends Base
{
    protected $wid    = 'subscribes';
    protected $wtitle = 'Subscribes';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        //$this->data['properties']["order_by"] = [

        $this->data['properties']['subscribe_email']                 = [
            'type'    => 'string',
            'title'   => 'Новини',
            'default' => 'Новини',
        ];
        $this->data['properties']['header']                 = [
            'type'    => 'string',
            'title'   => 'header',
            'default' => 'header',
        ];
        $this->data['properties']['consent']                         = [
            'type'    => 'string',
            'title'   => 'ДАЮ СВОЮ ЗГОДУ НА ОБРОБКУ ЗАЗНАЧЕНИХ МНОЮ ВИЩЕ ПЕРСОНАЛЬНИХ ДАНИХ',
            'default' => 'ДАЮ СВОЮ ЗГОДУ НА ОБРОБКУ ЗАЗНАЧЕНИХ МНОЮ ВИЩЕ ПЕРСОНАЛЬНИХ ДАНИХ',
        ];
        $this->data['properties']['placeholder']                     = [
            'type'    => 'string',
            'title'   => 'placeholder',
            'default' => 'placeholder',
        ];

        $this->data['properties']['phone']                           = [
            'type'    => 'string',
            'title'   => 'телефон',
            'default' => 'телефон',
        ];
        $this->data['properties']['patronymic']                      = [
            'type'    => 'string',
            'title'   => 'По-батькові',
            'default' => 'По-батькові',
        ];
        $this->data['properties']['surname']                         = [
            'type'    => 'string',
            'title'   => 'Прізвище',
            'default' => 'Прізвище',
        ];
        $this->data['properties']['E_Mail']                          = [
            'type'    => 'string',
            'title'   => 'E_Mail',
            'default' => 'E_Mail',
        ];
        $this->data['properties']['name']                            = [
            'type'    => 'string',
            'title'   => 'Ім’я',
            'default' => 'name',
        ];

        $this->data['properties']['submit']                              = [
            'type'    => 'string',
            'title'   => 'submit',
            'default' => 'submit',
        ];


        return $this->data;
    }
}