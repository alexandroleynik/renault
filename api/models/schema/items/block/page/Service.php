<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;
use \Yii;

class Service extends Base
{

    public function __construct()
    {
        $this->wid    = 'service';
        $this->wtitle = Yii::t('backend', 'Service');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']['t']['options']['hidden'] = false;
        $this->data['properties']['links']['options']['hidden'] = false;

        //$this->data['properties']["order_by"] = [

        $this->data['properties']['service']      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'service'),
            'default' => 'SERVICE',
        ];
        $this->data['properties']['find_dealer']  = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Знайти дилера'),
            'default' => 'Знайти дилера',
        ];
        $this->data['properties']['contact_info'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Контактна інформація'),
            'default' => 'Контактна інформація',
        ];

        $this->data['properties']['experience_renault_for_yourself'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Experience Renault for yourself.'),
            'default' => 'Experience Renault for yourself.',
        ];

        $this->data['properties']['please_select']     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Please select'),
            'default' => 'Оберіть будь ласка',
        ];
        $this->data['properties']['your_contact_info'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'your_contact_info'),
            'default' => 'your_contact_info',
        ];


        $this->data['properties']['select_date_and_time'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'select_date_and_time'),
            'default' => 'select_date_and_time',
        ];
        $this->data['properties']['select_date']          = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'select_date'),
            'default' => 'select_date',
        ];
        $this->data['properties']['select_time']          = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'select_time'),
            'default' => 'select_time',
        ];
        $this->data['properties']['select_call_time']     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'select_call_time'),
            'default' => 'select_call_time',
        ];
        $this->data['properties']['connect_type']         = [
            'type'    => 'string',
            'title'   => "Бажаний канал зв'язку",
            'default' => "Бажаний канал зв'язку",
        ];

        $this->data['properties']['change_this_datetime'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'change_this_datetime'),
            'default' => 'change_this_datetime',
        ];
        $this->data['properties']['subscribe_email']      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'subscribe_email'),
            'default' => 'subscribe_email',
        ];
        $this->data['properties']['consent']              = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'consent'),
            'default' => 'consent',
        ];
        $this->data['properties']['placeholder']          = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'placeholder'),
            'default' => 'placeholder',
        ];
        $this->data['properties']['Subscribe_to_news']    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Subscribe_to_news'),
            'default' => 'Subscribe_to_news',
        ];
        $this->data['properties']['subscribe_sms']        = [
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
        $this->data['properties']['phone']                = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'phone'),
            'default' => 'phone',
        ];
        $this->data['properties']['phone_placeholder']                      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'phone_placeholder'),
            'default' => '3503535',
        ];
        $this->data['properties']['patronymic']           = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'patronymic'),
            'default' => 'patronymic',
        ];
        $this->data['properties']['patronymic_placeholder']                 = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'patronymic_placeholder'),
            'default' => 'Тарасович',
        ];
        $this->data['properties']['surname']              = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'surname'),
            'default' => 'surname',
        ];
        $this->data['properties']['surname_placeholder']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'surname_placeholder'),
            'default' => 'Шевченко',
        ];
        $this->data['properties']['E_Mail']               = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'E_Mail'),
            'default' => 'E_Mail',
        ];
        ;$this->data['properties']['E_Mail_placeholder']                     = [
        'type'    => 'string',
        'title'   => Yii::t('backend', 'E_Mail_placeholder'),
        'default' => 'example@ukr.net',
    ];
        $this->data['properties']['name']                 = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'name'),
            'default' => 'name',
        ];
        $this->data['properties']['name_placeholder']                       = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'name'),
            'default' => 'Тарас',
        ];
        $this->data['properties']['accost']               = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'accost'),
            'default' => 'accost',
        ];
        $this->data['properties']['Mr']                   = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Mr'),
            'default' => 'Mr',
        ];
        $this->data['properties']['Ms']                   = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Ms'),
            'default' => 'Ms',
        ];
        $this->data['properties']['model']                = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Модель'),
            'default' => 'Модель',
        ];
        $this->data['properties']['VIN']                  = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'VIN'),
            'default' => 'VIN',
        ];

        $this->data['properties']['select_this_dealer']    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'select this dealer'),
            'default' => 'select this dealer',
        ];
        $this->data['properties']['served_before']         = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Чи обслуговувалися Ви у нас раніше?'),
            'default' => 'Чи обслуговувалися Ви у нас раніше?',
        ];
        $this->data['properties']['yes']                   = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Так'),
            'default' => 'Так',
        ];
        $this->data['properties']['no']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Ні'),
            'default' => 'Ні',
        ];
        $this->data['properties']['the_reason_for_appeal'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'причина звернення'),
            'default' => 'причина звернення',
        ];

        $this->data['properties']['reason_for_appeal'] = [
            'type'    => 'array',
            'title'   => Yii::t('backend', 'Причини звернення'),
            'options' => [
                'collapsed' => true,
            ],
            'items'   => [
                'type'       => 'object',
                'title'      => Yii::t('backend', 'причина звернення'),
                'options'    => [
                    'collapsed' => true,
                ],
                'properties' => [
                    'reason' => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Причина.'),
                        'default' => 'Причина',
                    ],
                ],
            ],
        ];

        $this->data['properties']['description_of_the_problem'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'описание неисправности'),
            'default' => 'описание неисправности',
        ];
        $this->data['properties']['submit']                     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Відправити'),
            'default' => 'відправити',
        ];

        return $this->data;
    }
}