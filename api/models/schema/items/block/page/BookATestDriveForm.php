<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;
use \Yii;

class BookATestDriveForm extends Base
{

    public function __construct()
    {
        $this->wid    = 'book-a-test-drive-form';
        $this->wtitle = Yii::t('backend', 'Book a test drive form');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']['t']['options']['hidden'] = false;
        $this->data['properties']['links']['options']['hidden'] = false;

        //$this->data['properties']["order_by"] = [

        $this->data['properties']['book_a_test_drive']               = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Book a test drive'),
            'default' => 'ЗАПИСАТИСЯ НА ТЕСТ-ДРАЙВ',
        ];
        $this->data['properties']['experience_renault_for_yourself'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Experience Renault for yourself.'),
            'default' => 'Experience Renault for yourself.',
        ];
        $this->data['properties']['i_d_like_to_book_a_test_drive']   = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'I’d like to book a test drive'),
            'default' => 'Я ХОЧУ ЗАПИСАТИСЯ НА ТЕСТ-ДРАЙВ',
        ];
        $this->data['properties']['please_select']                   = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Please select'),
            'default' => 'Оберіть будь ласка',
        ];
        $this->data['properties']['category_title']                  = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Category title'),
            'default' => 'Новинки',
        ];
        $this->data['properties']['subcategory_title']               = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Subcategory title'),
            'default' => 'Автомобілі',
        ];
        $this->data['properties']['find_a_dealer']                   = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Find a dealer'),
            'default' => 'Знайти дилера',
        ];
        $this->data['properties']['contact_info']                   = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Сontact info'),
            'default' => 'Контактна інформація',
        ];
        $this->data['properties']['your_contact_info']               = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Your contact info'),
            'default' => 'ВАША КОНТКТНА ІНФОРМАЦІЯ',
        ];
        $this->data['properties']['book_test_drive']                 = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Забронювати тест драйв'),
            'default' => 'Забронювати тест драйв',
        ];
        $this->data['properties']['select_date_and_time']            = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'select_date_and_time'),
            'default' => 'select_date_and_time',
        ];
        $this->data['properties']['change_this_datetime']            = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'change_this_datetime'),
            'default' => 'change_this_datetime',
        ];
        $this->data['properties']['subscribe_email']                 = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'subscribe_email'),
            'default' => 'subscribe_email',
        ];
        $this->data['properties']['consent']                         = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'consent'),
            'default' => 'consent',
        ];
        $this->data['properties']['placeholder']                     = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'placeholder'),
            'default' => 'placeholder',
        ];
        $this->data['properties']['Subscribe_to_news']               = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Subscribe_to_news'),
            'default' => 'Subscribe_to_news',
        ];
        $this->data['properties']['subscribe_sms']                   = [
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
        $this->data['properties']['phone']                           = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'phone'),
            'default' => 'phone',
        ];
        $this->data['properties']['phone_placeholder']                      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'phone_placeholder'),
            'default' => 'Мобільний телефон',
        ];
        $this->data['properties']['patronymic']                      = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'patronymic'),
            'default' => 'patronymic',
        ];
        $this->data['properties']['patronymic_placeholder']                 = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'patronymic_placeholder'),
            'default' => 'Григорович',
        ];
        $this->data['properties']['surname']                         = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'surname'),
            'default' => 'surname',
        ];
        $this->data['properties']['surname_placeholder']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'surname_placeholder'),
            'default' => 'Шевченко',
        ];
        $this->data['properties']['E_Mail']                          = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'E_Mail'),
            'default' => 'E_Mail',
        ];
        ;$this->data['properties']['E_Mail_placeholder']                     = [
        'type'    => 'string',
        'title'   => Yii::t('backend', 'E_Mail_placeholder'),
        'default' => 'taras@ukr.net',
    ];
        $this->data['properties']['name']                            = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'name'),
            'default' => 'name',
        ];
        $this->data['properties']['name_placeholder']                       = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'name'),
            'default' => 'Тарас',
        ];
        $this->data['properties']['accost']                          = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'accost'),
            'default' => 'accost',
        ];
        $this->data['properties']['Mr']                              = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Mr'),
            'default' => 'Mr',
        ];
        $this->data['properties']['Ms']                              = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Ms'),
            'default' => 'Ms',
        ];
        $this->data['properties']['select_this_dealer']              = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'select this dealer'),
            'default' => 'select this dealer',
        ];
        $this->data['properties']['items']                           = [
            'type'    => 'array',
            'title'   => Yii::t('backend', 'Images for slider.'),
            'options' => [
                'collapsed' => true,
            ],
            'items'   => [
                'type'       => 'object',
                'title'      => Yii::t('backend', 'Vehicle images'),
                'options'    => [
                    'collapsed' => true,
                ],
                'properties' => [
                    'title'   => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Title.'),
                        'default' => 'Dokker',
                    ],
                    'img_src' => [
                        'type'    => 'string',
                        'format'  => 'url',
                        'title'   => Yii::t('backend', 'image300х190'),
                        'options' => [
                            'upload' => true,
                        ],
                        'links'   => [
                            '0' => [
                                'href' => '{{self}}',
                                'rel'  => 'View file',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return $this->data;
    }
}
