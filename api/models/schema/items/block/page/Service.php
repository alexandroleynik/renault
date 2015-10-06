<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;

class Service extends Base
{
    protected $wid    = 'service';
    protected $wtitle = 'Service';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        //$this->data['properties']["order_by"] = [
        $this->data['properties']['service']               = [
            'type'    => 'string',
            'title'   => 'service',
            'default' => 'SERVICE',
        ];
        $this->data['properties']['experience_renault_for_yourself'] = [
            'type'    => 'string',
            'title'   => 'Experience Renault for yourself.',
            'default' => 'Experience Renault for yourself.',
        ];

        $this->data['properties']['please_select']                   = [
            'type'    => 'string',
            'title'   => 'Please select',
            'default' => 'Оберіть будь ласка',
        ];
        $this->data['properties']['your_contact_info']                   = [
            'type'    => 'string',
            'title'   => 'your_contact_info',
            'default' => 'your_contact_info',
        ];


        $this->data['properties']['select_date_and_time']            = [
            'type'    => 'string',
            'title'   => 'select_date_and_time',
            'default' => 'select_date_and_time',
        ];
         $this->data['properties']['select_date']            = [
            'type'    => 'string',
            'title'   => 'select_date',
            'default' => 'select_date',
        ];
        $this->data['properties']['select_time']            = [
            'type'    => 'string',
            'title'   => 'select_time',
            'default' => 'select_time',
        ];
        $this->data['properties']['select_call_time']            = [
            'type'    => 'string',
            'title'   => 'select_call_time',
            'default' => 'select_call_time',
        ]; $this->data['properties']['connect_type']            = [
            'type'    => 'string',
            'title'   => "Бажаний канал зв'язку",
            'default' => "Бажаний канал зв'язку",
        ];

        $this->data['properties']['change_this_datetime']            = [
            'type'    => 'string',
            'title'   => 'change_this_datetime',
            'default' => 'change_this_datetime',
        ];
        $this->data['properties']['subscribe_email']                 = [
            'type'    => 'string',
            'title'   => 'subscribe_email',
            'default' => 'subscribe_email',
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
        $this->data['properties']['model']                              = [
            'type'    => 'string',
            'title'   => 'Модель',
            'default' => 'Модель',
        ];$this->data['properties']['VIN']                              = [
        'type'    => 'string',
        'title'   => 'VIN',
        'default' => 'VIN',
    ];

        $this->data['properties']['select_this_dealer']              = [
            'type'    => 'string',
            'title'   => 'select this dealer',
            'default' => 'select this dealer',
        ];
        $this->data['properties']['served_before']              = [
            'type'    => 'string',
            'title'   => 'Чи обслуговувалися Ви у нас раніше?',
            'default' => 'Чи обслуговувалися Ви у нас раніше?',
        ];
        $this->data['properties']['yes']              = [
            'type'    => 'string',
            'title'   => 'Так',
            'default' => 'Так',
        ];
        $this->data['properties']['no']              = [
            'type'    => 'string',
            'title'   => 'Ні',
            'default' => 'Ні',
        ];
        $this->data['properties']['the_reason_for_appeal']              = [
            'type'    => 'string',
            'title'   => 'причина звернення',
            'default' => 'причина звернення',
        ];

        $this->data['properties']['reason_for_appeal']                           = [
            'type'    => 'array',
            'title'   => 'Причини звернення',
            'options' => [
                'collapsed' => true,
            ],
            'items'   => [
                'type'       => 'object',
                'title'      => 'причина звернення',
                'options'    => [
                    'collapsed' => true,
                ],
                'properties' => [
                    'reason'   => [
                        'type'    => 'string',
                        'title'   => 'Причина.',
                        'default' => 'Причина',
                    ],

                ],
            ],
        ];

        $this->data['properties']['description_of_the_problem']              = [
            'type'    => 'string',
            'title'   => 'описание неисправности',
            'default' => 'описание неисправности',
        ];
        $this->data['properties']['submit']              = [
            'type'    => 'string',
            'title'   => 'Відправити',
            'default' => 'відправити',
        ];

        return $this->data;
    }
}