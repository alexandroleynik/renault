<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;
use \Yii;

class ContactForm extends Base
{

    public function __construct()
    {
        $this->wid    = 'contact-form';
        $this->wtitle = Yii::t('backend', 'Contact Form');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        //cusom code here
        $this->data['properties']['name']                       = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'name'),
            'default' => 'Ім\'я',
        ];
        $this->data['properties']["text"] = [
            "type"    => "string",
            "format"  => "html",
            "options" => [
                "wysiwyg" => true
            ],
            "title"   => Yii::t('backend', 'Text.'),
            "default" => "Lorem ipsum dolor sit amet, consectetur adipiscing."
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

        $this->data['properties']['select_dealers']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'select_dealers'),
            'default' => 'Виберіть дилера',
        ];

        $this->data['properties']['other']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Other'),
            'default' => 'Інший',
        ];

        $this->data['properties']['submit']                    = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Submit'),
            'default' => 'Submit',
        ];

        return $this->data;
    }
}
