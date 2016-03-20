<?php

namespace api\models\schema\items\arrays\objects;

use api\models\schema\base\Base;
use common\models\Price;
use \Yii;

class Characteristics extends Base
{
    public function __construct()
    {
        $this->wid    = 'characteristics';
        $this->wtitle = Yii::t('backend', 'Characteristics');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["eqandspec"]           = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'Оборудование и характеристики'),
            "default" => "Оборудование и характеристики Нового Renault DUSTER"
        ];
        $this->data['properties']["header"]              = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'Оборудование и характеристики'),
            "default" => "Оборудование и характеристики Нового Renault DUSTER",
            "options" => [
                "hidden" => true
            ],
        ];
        $this->data['properties']["equipment_text"]      = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'Обладнання'),
            "default" => "Обладнання"
        ];
        $this->data['properties']["sub_header"]          = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'Обладнання'),
            "default" => "Обладнання",
            "options" => [
                "hidden" => true
            ],
        ];
        $this->data['properties']["specifications_text"] = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'ТЕХНИЧЕСКИЕ ХАРАКТЕРИСТИКИ'),
            "default" => "ТЕХНИЧЕСКИЕ ХАРАКТЕРИСТИКИ"
        ];

        $this->data['properties']["model"] = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'Модель'),
            "default" => "Новий Renault Logan"
        ];

        $versionCodes = Price::getAllVersionCodesEnum();

        $this->data['properties']["items"] = [
            "type"    => 'array',
            'title'   => Yii::t('backend', 'Комплектація'),
            'options' => [
                'collapsed' => true
            ],
            'items'   => [
                'type'       => 'object',
                'title' => Yii::t('backend', 'Комплектація'),
                'options'    => [
                    'collapsed' => true
                ],
                'properties' => [
                    'title'              => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Назва Комплектації'),
                        'default' => 'Access'
                    ],
                    'cost'               => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Початкова ціна'),
                        'default' => '399 000 руб.'
                    ],
                    'version_code'        => $versionCodes,
                    'link_title'         => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Текст посилання'),
                        'default' => 'Узнать больше'
                    ],
                    'link_href'          => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Адреса посилання'),
                        'gefault' => '#'
                    ],
                    'alt'                => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'alt'),
                        'default' => 'alt'
                    ],
                    'img_src'            => [
                        'type'    => 'string',
                        'format'  => 'url',
                        'title'   => Yii::t('backend', 'Image640x440'),
                        'options' => [
                            'upload' => true
                        ],
                        "links" => [
                            [
                                "href" => "{{self}}",
                                "rel" => "View file"
                            ]
                        ]
                    ],
                    'link_configur'      => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Текст посилання конфігуратора'),
                        'default' => 'Конфігуратор'
                    ],
                    'link_configur_href' => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Адреса посилання конфігуратора'),
                        'gefault' => '#'
                    ],
                    'engine'             => [
                        "type"    => 'array',
                        'title'   => Yii::t('backend', 'Двигун'),
                        'options' => [
                            'collapsed' => true
                        ],
                        'items'   => [
                            'type'       => 'object',
                            'title' => Yii::t('backend', 'Двигун'),
                            'options'    => [
                                'collapsed' => true
                            ],
                            'properties' => [

                                'title_eng'   => [
                                    'type'    => 'string',
                                    'title'   => Yii::t('backend', 'Назва двигуна'),
                                    'default' => 'Access'
                                ],
                                'power'       => [
                                    'type'    => 'string',
                                    'title'   => Yii::t('backend', 'Потужність'),
                                    'default' => '399 000 руб.'
                                ],
                                'volume'      => [
                                    'type'    => 'string',
                                    'title'   => Yii::t('backend', 'Об’єм'),
                                    'default' => '1.2 л'
                                ],
                                'consumption' => [
                                    'type'    => 'string',
                                    'title'   => Yii::t('backend', 'Витрати пального'),
                                    'default' => 'Access'
                                ],
                                'cost'        => [
                                    'type'    => 'string',
                                    'title'   => Yii::t('backend', 'Початкова ціна'),
                                    'default' => '399 000 руб.'
                                ],
                                'version_code'        => $versionCodes,
                            ]
                        ]
                    ],
                    'equipment'          => [
                        "type"    => 'array',
                        'title'   => Yii::t('backend', 'Обладнання'),
                        'options' => [
                            'collapsed' => true
                        ],
                        'items'   => [
                            'type'       => 'object',
                            'title' => Yii::t('backend', 'item'),
                            'options'    => [
                                'collapsed' => true
                            ],
                            'properties' => [

                                'title' => [
                                    'type'    => 'string',
                                    'title'   => Yii::t('backend', 'Заголовок'),
                                    'default' => 'Access'
                                ],
                                'text'  => [
                                    'type'    => 'string',
                                    'title'   => Yii::t('backend', 'Текст'),
                                    "format"  => "html",
                                    "options" => [
                                        "wysiwyg" => true
                                    ],
                                    'default' => ''
                                ],
                            ]
                        ]
                    ],
                    'specifications'     => [
                        "type"    => 'array',
                        'title'   => Yii::t('backend', 'Характеристики'),
                        'options' => [
                            'collapsed' => true
                        ],
                        'items'   => [
                            'type'       => 'object',
                            'title' => Yii::t('backend', 'item'),
                            'options'    => [
                                'collapsed' => true
                            ],
                            'properties' => [

                                'title' => [
                                    'type'    => 'string',
                                    'title'   => Yii::t('backend', 'Заголовок'),
                                    'default' => 'Access'
                                ],
                                'text'  => [
                                    'type'    => 'string',
                                    'title'   => Yii::t('backend', 'Текст'),
                                    "format"  => "html",
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
