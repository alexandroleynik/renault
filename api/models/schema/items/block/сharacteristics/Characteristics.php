<?php

namespace api\models\schema\items\block\сharacteristics;

use api\models\schema\base\Base;

class Characteristics extends Base
{
    protected $wid = 'сharacteristics';
    protected $wtitle = 'Characteristics';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["header"] = [

            "type" => "string",
            "title" => "Заголовок",
            "default" => "Выберите свою комплектацию"
        ];
        $this->data['properties']["sub_header"] = [

            "type" => "string",
            "title" => "Заголовок 2",
            "default" => "Узнайте больше о технических характеристиках и оборудовании для своего автомобиля."
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
                    'engine' => [
                        'type' => 'array',
                        'title' => 'Двигун',
                        'options' => [
                            'collapsed' => true
                        ],
                        'properties' => [
                            'items' => [
                                'type' => 'object',
                                'title' => 'item',

                                'options' => [
                                    'collapsed' => true
                                ],
                                'properties' => [
                                    'items' => [
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
                                ] ]

                            ]
                        ]
                    ],
                        'equipment' => [
                            'type' => 'object',
                            'title' => 'Обладняння',

                            'options' => [
                                'collapsed' => true
                            ],
                            'properties' => [
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
                            ]
                        ],
                        'specifications' => [
                            'type' => 'object',
                            'title' => 'specifications',

                            'options' => [
                                'collapsed' => true
                            ],
                            'properties' => [
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
                            ]
                        ],

                    ]


                ]


        ];


        return $this->data;
    }
}