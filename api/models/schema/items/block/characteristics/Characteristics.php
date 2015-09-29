<?php

namespace api\models\schema\items\block\characteristics;

use api\models\schema\base\Base;

class Characteristics extends Base
{
    protected $wid = 'characteristics';
    protected $wtitle = 'Characteristics';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["eqandspec"] = [

            "type" => "string",
            "title" => "Оборудование и характеристики",
            "default" => "Оборудование и характеристики Нового Renault DUSTER"
        ];
        $this->data['properties']["equipment_text"] = [

            "type" => "string",
            "title" => "Обладнання",
            "default" => "Обладнання"
        ];
        $this->data['properties']["specifications_text"] = [

            "type" => "string",
            "title" => "ТЕХНИЧЕСКИЕ ХАРАКТЕРИСТИКИ",
            "default" => "ТЕХНИЧЕСКИЕ ХАРАКТЕРИСТИКИ"
        ];

        $this->data['properties']["model"] = [

            "type" => "string",
            "title" => "Модель",
            "default" => "Новий Renault Logan"
        ];

        $this->data['properties']["items"] = [
            "type" => 'array',
            'title' => 'Комплектація',
            'options' => [
                'collapsed' => true
            ],
            'items' => [
                'type' => 'object',
                'title' => 'Комплектація',

                'options' => [
                    'collapsed' => true
                ],
                'properties' => [
                    'title' => [
                        'type' => 'string',
                        'title' => 'Назва Комплектації',
                        'default' => 'Access'
                    ],
                    'cost' => [
                        'type' => 'string',
                        'title' => 'Початкова ціна',
                        'default' => '399 000 руб.'
                    ],
                    'link_title' => [
                        'type' => 'string',
                        'title' => 'Текст посилання',
                        'default' => 'Узнать больше'
                    ],
                    'link_href' => [
                        'type' => 'string',
                        'title' => 'Адреса посилання',
                        'gefault' => '#'
                    ],
                    'alt' => [
                        'type' => 'string',
                        'title' => 'alt',
                        'default' => 'alt'
                    ],
                    'img_src' => [
                        'type' => 'string',
                        'format' => 'url',
                        'title' => 'Зображення',
                        'options' => [
                            'upload' => true
                        ],
                        'links' => [
                            'href' => '{{self}}',
                            'rel' => 'View file'
                        ]
                    ],
                    'link_configur' => [
                        'type' => 'string',
                        'title' => 'Текст посилання конфігуратора',
                        'default' => 'Конфігуратор'
                    ],
                    'link_configur_href' => [
                        'type' => 'string',
                        'title' => 'Адреса посилання конфігуратора',
                        'gefault' => '#'
                    ],
                    'engine' => [
                        "type" => 'array',
                        'title' => 'Двигун',
                        'options' => [
                            'collapsed' => true
                        ],
                        'items' => [
                            'type' => 'object',
                            'title' => 'Двигун',

                            'options' => [
                                'collapsed' => true
                            ],
                            'properties' => [

                                'title_eng' => [
                                    'type' => 'string',
                                    'title' => 'Назва двигуна',
                                    'default' => 'Access'
                                ],
                                'power' => [
                                    'type' => 'string',
                                    'title' => 'Потужність',
                                    'default' => '399 000 руб.'
                                ],
                                'volume' => [
                                    'type' => 'string',
                                    'title' => 'Об’єм',
                                    'default' => '1.2 л'
                                ],
                                'consumption' => [
                                    'type' => 'string',
                                    'title' => 'Витрати пального',
                                    'default' => 'Access'
                                ],

                                'cost' => [
                                    'type' => 'string',
                                    'title' => 'Початкова ціна',
                                    'default' => '399 000 руб.'
                                ],


                            ]
                        ]
                    ],

                    'equipment' => [
                        "type" => 'array',
                        'title' => 'Обладнання',
                        'options' => [
                            'collapsed' => true
                        ],
                        'items' => [
                            'type' => 'object',
                            'title' => 'item',

                            'options' => [
                                'collapsed' => true
                            ],
                            'properties' => [

                                'title' => [
                                    'type' => 'string',
                                    'title' => 'Заголовок',
                                    'default' => 'Access'
                                ],
                                'text' => [
                                    'type' => 'string',
                                    'title' => 'Текст',
                                    "format" => "html",
                                    "options" => [
                                        "wysiwyg" => true
                                    ],
                                    'default' => ''
                                ],


                            ]
                        ]
                    ],
                    'specifications' => [
                        "type" => 'array',
                        'title' => 'Характеристики',
                        'options' => [
                            'collapsed' => true
                        ],
                        'items' => [
                            'type' => 'object',
                            'title' => 'item',

                            'options' => [
                                'collapsed' => true
                            ],
                            'properties' => [

                                'title' => [
                                    'type' => 'string',
                                    'title' => 'Заголовок',
                                    'default' => 'Access'
                                ],
                                'text' => [
                                    'type' => 'string',
                                    'title' => 'Текст',
                                    "format" => "html",
                                    "options" => [
                                        "wysiwyg" => true
                                    ],
                                    'default' => ''
                                ],


                            ]
                        ]
                    ],


                ]


            ]


        ];


        return $this->data;
    }
}