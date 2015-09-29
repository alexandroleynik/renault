<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;

class BookATestDriveForm extends Base
{
    protected $wid    = 'book-a-test-drive-form';
    protected $wtitle = 'Book a test drive form';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        //$this->data['properties']["order_by"] = [
        $this->data['properties']['book_a_test_drive']               = [
            'type'    => 'string',
            'title'   => 'Book a test drive',
            'default' => 'ЗАПИСАТИСЯ НА ТЕСТ-ДРАЙВ',
        ];
        $this->data['properties']['experience_renault_for_yourself'] = [
            'type'    => 'string',
            'title'   => 'Experience Renault for yourself.',
            'default' => 'Experience Renault for yourself.',
        ];
        $this->data['properties']['i_d_like_to_book_a_test_drive']   = [
            'type'    => 'string',
            'title'   => 'I’d like to book a test drive',
            'default' => 'Я ХОЧУ ЗАПИСАТИСЯ НА ТЕСТ-ДРАЙВ',
        ];
        $this->data['properties']['please_select']                   = [
            'type'    => 'string',
            'title'   => 'Please select',
            'default' => 'Оберіть будь ласка',
        ];
        $this->data['properties']['category_title']                  = [
            'type'    => 'string',
            'title'   => 'Category title',
            'default' => 'Новинки',
        ];
        $this->data['properties']['subcategory_title']               = [
            'type'    => 'string',
            'title'   => 'Subcategory title',
            'default' => 'Автомобілі',
        ];
        $this->data['properties']['find_a_dealer']                   = [
            'type'    => 'string',
            'title'   => 'Find a dealer',
            'default' => 'Знайти дилера',
        ];
        $this->data['properties']['your_contact_info']               = [
            'type'    => 'string',
            'title'   => 'Your contact info',
            'default' => 'ВАША КОНТКТНА ІНФОРМАЦІЯ',
        ];
        $this->data['properties']['book_test_drive']                 = [
            'type'    => 'string',
            'title'   => 'Забронювати тест драйв',
            'default' => 'Забронювати тест драйв',
        ];
        $this->data['properties']['select_date_and_time']            = [
            'type'    => 'string',
            'title'   => 'select_date_and_time',
            'default' => 'select_date_and_time',
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
        $this->data['properties']['select_this_dealer']              = [
            'type'    => 'string',
            'title'   => 'select this dealer',
            'default' => 'select this dealer',
        ];
        $this->data['properties']['items']                           = [
            'type'    => 'array',
            'title'   => 'Images for slider.',
            'options' => [
                'collapsed' => true,
            ],
            'items'   => [
                'type'       => 'object',
                'title'      => 'Vehicle images',
                'options'    => [
                    'collapsed' => true,
                ],
                'properties' => [
                    'title'   => [
                        'type'    => 'string',
                        'title'   => 'Title.',
                        'default' => 'Dokker',
                    ],
                    'img_src' => [
                        'type'    => 'string',
                        'format'  => 'url',
                        'title'   => 'Some image.',
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