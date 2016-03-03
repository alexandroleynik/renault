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
        $this->data['properties']['t']['options']['hidden'] = false;
        $this->data['properties']['links']['options']['hidden'] = false;

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
        $this->data['properties']['phone']             = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'phone'),
            'default' => 'phone',
        ];
        $this->data['properties']['phone_placeholder']                      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'phone'),
            'default' => 'Мобільний телефон',
        ];
        $this->data['properties']['patronymic']        = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'patronymic'),
            'default' => 'patronymic',
        ];
        $this->data['properties']['patronymic_placeholder']                 = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'patronymic_placeholder'),
            'default' => 'Григорович',
        ];
        $this->data['properties']['surname']           = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'surname'),
            'default' => 'surname',
        ];
        $this->data['properties']['surname_placeholder']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'surname_placeholder'),
            'default' => 'Шевченко',
        ];
        $this->data['properties']['E_Mail']            = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'E_Mail'),
            'default' => 'E_Mail',
        ];
        ;$this->data['properties']['E_Mail_placeholder']                     = [
        'type'    => 'string',
        'title'   => Yii::t('backend', 'E_Mail_placeholder'),
        'default' => 'taras@ukr.net',
    ];
        $this->data['properties']['name']              = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'name'),
            'default' => 'name',
        ];
        $this->data['properties']['name_placeholder']                       = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'name'),
            'default' => 'Тарас',
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