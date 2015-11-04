<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;
use \Yii;

class Subscribes extends Base
{

    public function __construct()
    {
        $this->wid    = 'subscribes';
        $this->wtitle = Yii::t('backend', 'Subscribes');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        //$this->data['properties']["order_by"] = [

        $this->data['properties']['subscribe_email'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Новини'),
            'default' => 'Новини',
        ];
        $this->data['properties']['header']          = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'header'),
            'default' => 'header',
        ];
        $this->data['properties']['consent']         = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'ДАЮ СВОЮ ЗГОДУ НА ОБРОБКУ ЗАЗНАЧЕНИХ МНОЮ ВИЩЕ ПЕРСОНАЛЬНИХ ДАНИХ'),
            'default' => 'ДАЮ СВОЮ ЗГОДУ НА ОБРОБКУ ЗАЗНАЧЕНИХ МНОЮ ВИЩЕ ПЕРСОНАЛЬНИХ ДАНИХ',
        ];
        $this->data['properties']['placeholder']     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'placeholder'),
            'default' => 'placeholder',
        ];

        $this->data['properties']['phone']      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'телефон'),
            'default' => 'телефон',
        ];
        $this->data['properties']['patronymic'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'По-батькові'),
            'default' => 'По-батькові',
        ];
        $this->data['properties']['surname']    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Прізвище'),
            'default' => 'Прізвище',
        ];
        $this->data['properties']['E_Mail']     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'E_Mail'),
            'default' => 'E_Mail',
        ];
        $this->data['properties']['name']       = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Ім’я'),
            'default' => 'name',
        ];

        $this->data['properties']['submit'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'submit'),
            'default' => 'submit',
        ];


        return $this->data;
    }
}