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
        $this->data['properties']['t']['options']['hidden'] = false;
        $this->data['properties']['links']['options']['hidden'] = false;

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
        $this->data['properties']['phone_code_title']                           = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'phone_code_title'),
            'default' => 'phone_code',
        ];
        $this->data['properties']['phone_code']                           = [
            'type'    => 'array',
            'title'   => Yii::t('backend', 'add phone code'),
            'options' => [
                'collapsed' => true,
            ],
            'items'   => [
                'type'       => 'object',
                'title'      => Yii::t('backend', 'phone_code_title'),
                'options'    => [
                    'collapsed' => true,
                ],
                'properties' => [
                    'title'   => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'phone_code.'),
                        'default' => '055',
                    ],

                ],
            ],
        ];
        $this->data['properties']['phone']      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'телефон'),
            'default' => 'телефон',
        ];
        $this->data['properties']['phone_placeholder']                      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'phone'),
            'default' => 'Мобільний телефон',
        ];
        $this->data['properties']['patronymic'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'По-батькові'),
            'default' => 'По-батькові',
        ];
        $this->data['properties']['patronymic_placeholder']                 = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'patronymic_placeholder'),
            'default' => 'Григорович',
        ];
        $this->data['properties']['surname']    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Прізвище'),
            'default' => 'Прізвище',
        ];
        $this->data['properties']['surname_placeholder']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'surname_placeholder'),
            'default' => 'Шевченко',
        ];
        $this->data['properties']['E_Mail']     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'E_Mail'),
            'default' => 'E_Mail',
        ];
        ;$this->data['properties']['E_Mail_placeholder']                     = [
        'type'    => 'string',
        'title'   => Yii::t('backend', 'E_Mail_placeholder'),
        'default' => 'taras@ukr.net',
    ];
        $this->data['properties']['name']       = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Ім’я'),
            'default' => 'name',
        ];
        $this->data['properties']['name_placeholder']                       = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'name'),
            'default' => 'Тарас',
        ];
        $this->data['properties']['submit'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'submit'),
            'default' => 'submit',
        ];


        return $this->data;
    }
}