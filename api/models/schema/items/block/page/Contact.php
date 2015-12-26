<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;
use \Yii;

class Contact extends Base
{

    public function __construct()
    {
        $this->wid    = 'contact';
        $this->wtitle = Yii::t('backend', 'Contact');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']['title']                      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'contact'),
            'default' => 'contact',
        ];
         $this->data['properties']['contact_info']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Contact info'),
            'default' => 'Contact info',
        ];
        $this->data['properties']['subscribe_email']            = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'subscribe_email'),
            'default' => 'subscribe_email',
        ];
        $this->data['properties']['consent']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'consent'),
            'default' => '<a href=\'http://m.renault.ua/uk/privacy-policy\' target=\'_blank\'> ДАЮ СВОЮ ЗГОДУ НА ОБРОБКУ ЗАЗНАЧЕНИХ МНОЮ ВИЩЕ ПЕРСОНАЛЬНИХ ДАНИХ</a>',
        ];
        $this->data['properties']['subscribe_to_news']          = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Subscribe_to_news'),
            'default' => 'Підписатися на новини Renault',
        ];
        $this->data['properties']['subscribe_sms']              = [
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
        $this->data['properties']['phone']                      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'phone'),
            'default' => 'Мобільний телефон',
        ];
        $this->data['properties']['comment']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'comment'),
            'default' => 'Ваше питання',
        ];
        $this->data['properties']['patronymic']                 = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'patronymic'),
            'default' => 'По батькові',
        ];
        $this->data['properties']['surname']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'surname'),
            'default' => 'Прізвище',
        ];
        $this->data['properties']['E_Mail']                     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'E_Mail'),
            'default' => 'E-Mail',
        ];
        $this->data['properties']['name']                       = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'name'),
            'default' => 'Ім\'я',
        ];
        $this->data['properties']['accost']                     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'accost'),
            'default' => 'Звертання',
        ];
        $this->data['properties']['Mr']                         = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Mr'),
            'default' => 'Пан',
        ];
        $this->data['properties']['Ms']                         = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Ms'),
            'default' => 'Пані',
        ];
        $this->data['properties']['Contact_Renault_in_Ukraine'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Зв\'язатися з Renault в Українi'),
            'default' => 'Зв\'язатися з Renault в Українi',
        ];
        $this->data['properties']['Search_button']              = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Search_button'),
            'default' => 'Search_button',
        ];
        $this->data['properties']['contact_info']               = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'contact_info'),
            'default' => 'contact_info',
        ];
        $this->data['properties']['placeholder']                = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'placeholder'),
            'default' => 'placeholder',
        ];
        $this->data['properties']['send']                       = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Відправити'),
            'default' => 'Відправити',
        ];
        $this->data['properties']['t']                          = [
            'type'        => 'array',
            'format'      => 'table',
            'title'       => Yii::t('backend', 'Translations'),
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
