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
            'title'   => 'subscribe_email',
            'default' => 'subscribe_email',
        ];
        $this->data['properties']['header']                 = [
            'type'    => 'string',
            'title'   => 'header',
            'default' => 'header',
        ];
        $this->data['properties']['consent']                         = [
            'type'    => 'string',
            'title'   => 'consent',
            'default' => 'consent',
        ];
        $this->data['properties']['placeholder']                     = [
            'type'    => 'string',
            'title'   => 'placeholder',
            'default' => 'placeholder',
        ];
        $this->data['properties']['Subscribe_to_news']               = [
            'type'    => 'string',
            'title'   => 'Subscribe_to_news',
            'default' => 'Subscribe_to_news',
        ];
        $this->data['properties']['subscribe_sms']                   = [
            'type'    => 'string',
            'title'   => 'subscribe_sms',
            'default' => 'subscribe_sms',
        ];
        $this->data['properties']['phone']                           = [
            'type'    => 'string',
            'title'   => 'phone',
            'default' => 'phone',
        ];
        $this->data['properties']['patronymic']                      = [
            'type'    => 'string',
            'title'   => 'patronymic',
            'default' => 'patronymic',
        ];
        $this->data['properties']['surname']                         = [
            'type'    => 'string',
            'title'   => 'surname',
            'default' => 'surname',
        ];
        $this->data['properties']['E_Mail']                          = [
            'type'    => 'string',
            'title'   => 'E_Mail',
            'default' => 'E_Mail',
        ];
        $this->data['properties']['name']                            = [
            'type'    => 'string',
            'title'   => 'name',
            'default' => 'name',
        ];
        $this->data['properties']['accost']                          = [
            'type'    => 'string',
            'title'   => 'accost',
            'default' => 'accost',
        ];
        $this->data['properties']['Mr']                              = [
            'type'    => 'string',
            'title'   => 'Mr',
            'default' => 'Mr',
        ];
        $this->data['properties']['Ms']                              = [
            'type'    => 'string',
            'title'   => 'Ms',
            'default' => 'Ms',
        ];
        $this->data['properties']['submit']                              = [
            'type'    => 'string',
            'title'   => 'submit',
            'default' => 'submit',
        ];


        return $this->data;
    }
}