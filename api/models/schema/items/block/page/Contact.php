<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;

class Contact extends Base
{
    protected $wid    = 'contact';
    protected $wtitle = 'Contact';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']['title']                      = [
            'type'    => 'string',
            'title'   => 'contact',
            'default' => 'contact',
        ];
        $this->data['properties']['subscribe_email']            = [
            'type'    => 'string',
            'title'   => 'subscribe_email',
            'default' => 'subscribe_email',
        ];
        $this->data['properties']['consent']                    = [
            'type'    => 'string',
            'title'   => 'consent',
            'default' => '<a href=\'http://m.renault.ua/uk/privacy-policy\' target=\'_blank\'> ДАЮ СВОЮ ЗГОДУ НА ОБРОБКУ ЗАЗНАЧЕНИХ МНОЮ ВИЩЕ ПЕРСОНАЛЬНИХ ДАНИХ</a>',
        ];
        $this->data['properties']['subscribe_to_news']          = [
            'type'    => 'string',
            'title'   => 'Subscribe_to_news',
            'default' => 'Підписатися на новини Renault',
        ];
        $this->data['properties']['subscribe_sms']              = [
            'type'    => 'string',
            'title'   => 'subscribe_sms',
            'default' => 'subscribe_sms',
        ];
        $this->data['properties']['phone']                      = [
            'type'    => 'string',
            'title'   => 'phone',
            'default' => 'Мобільний телефон',
        ];
        $this->data['properties']['comment']                    = [
            'type'    => 'string',
            'title'   => 'comment',
            'default' => 'Ваше питання',
        ];
        $this->data['properties']['patronymic']                 = [
            'type'    => 'string',
            'title'   => 'patronymic',
            'default' => 'По батькові',
        ];
        $this->data['properties']['surname']                    = [
            'type'    => 'string',
            'title'   => 'surname',
            'default' => 'Прізвище',
        ];
        $this->data['properties']['E_Mail']                     = [
            'type'    => 'string',
            'title'   => 'E_Mail',
            'default' => 'E-Mail',
        ];
        $this->data['properties']['name']                       = [
            'type'    => 'string',
            'title'   => 'name',
            'default' => 'Ім\'я',
        ];
        $this->data['properties']['accost']                     = [
            'type'    => 'string',
            'title'   => 'accost',
            'default' => 'Звертання',
        ];
        $this->data['properties']['Mr']                         = [
            'type'    => 'string',
            'title'   => 'Mr',
            'default' => 'Пан',
        ];
        $this->data['properties']['Ms']                         = [
            'type'    => 'string',
            'title'   => 'Ms',
            'default' => 'Пані',
        ];
        $this->data['properties']['Contact_Renault_in_Ukraine'] = [
            'type'    => 'string',
            'title'   => 'Зв\'язатися з Renault в Українi',
            'default' => 'Зв\'язатися з Renault в Українi',
        ];
        $this->data['properties']['Search_button']              = [
            'type'    => 'string',
            'title'   => 'Search_button',
            'default' => 'Search_button',
        ];
        $this->data['properties']['contact_info']               = [
            'type'    => 'string',
            'title'   => 'contact_info',
            'default' => 'contact_info',
        ];
        $this->data['properties']['placeholder']                = [
            'type'    => 'string',
            'title'   => 'placeholder',
            'default' => 'placeholder',
        ];
        $this->data['properties']['send']                       = [
            'type'    => 'string',
            'title'   => 'Відправити',
            'default' => 'Відправити',
        ];
        $this->data['properties']['t']                          = [
            'type'        => 'array',
            'format'      => 'table',
            'title'       => 'Translations',
            'uniqueItems' => true,
            'options'     => [
                'collapsed' => true,
            ],
            'items'       => [
                'type'       => 'object',
                'properties' => [
                    'key'   => [
                        'type'    => 'string',
                        'options' => [
                            'input_width' => '300px',
                        ],
                    ],
                    'value' => [
                        'type'    => 'string',
                        'options' => [
                            'input_width' => '400px',
                        ],
                    ],
                ],
            ],
        ];


        return $this->data;
    }
}