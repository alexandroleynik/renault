<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;
use \Yii;

class CorporateSales extends Base
{

    public function __construct()
    {
        $this->wid    = 'corporate-sales';
        $this->wtitle = Yii::t('backend', 'Corporate Sales');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        $this->data['properties']['my_email'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'my_email'),
            'default' => 'my_email',
        ];

        $this->data['properties']['header']    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'header'),
            'default' => 'header',
        ];
        $this->data['properties']['subheader'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'subheader'),
            'default' => 'subheader',
        ];

        $this->data['properties']['subscribe_email'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'subscribe_email'),
            'default' => 'subscribe_email',
        ];
        $this->data['properties']['consent']         = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'consent'),
            'default' => 'consent',
        ];

        $this->data['properties']['Subscribe_to_news'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Subscribe_to_news'),
            'default' => 'Subscribe_to_news',
        ];
        $this->data['properties']['subscribe_sms']     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'subscribe_sms'),
            'default' => 'subscribe_sms',
        ];
        $this->data['properties']['phone']             = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'phone'),
            'default' => 'phone',
        ];
        $this->data['properties']['patronymic']        = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'patronymic'),
            'default' => 'patronymic',
        ];
        $this->data['properties']['surname']           = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'surname'),
            'default' => 'surname',
        ];
        $this->data['properties']['E_Mail']            = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'E_Mail'),
            'default' => 'E_Mail',
        ];
        $this->data['properties']['name']              = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'name'),
            'default' => 'name',
        ];
        $this->data['properties']['accost']            = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'accost'),
            'default' => 'accost',
        ];
        $this->data['properties']['Mr']                = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Mr'),
            'default' => 'Mr',
        ];
        $this->data['properties']['Ms']                = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Ms'),
            'default' => 'Ms',
        ];
        $this->data['properties']['message']           = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'message'),
            'default' => 'message'
        ];
        $this->data['properties']['send']              = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'send'),
            'default' => 'send',
        ];

        return $this->data;
    }
}