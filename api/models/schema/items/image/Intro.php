<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 7:49 PM
 */

namespace api\models\schema\items\image;

use api\models\schema\base\Base;

class Intro extends Base
{

    protected $wid = 'intro';
    protected $wtitle = 'Intro';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["items"] = [
            "type" => 'array',
            'title' => 'Intro',
            'options' => [
                'collapsed' => true
            ],
            'items' => [
                'type' => 'object',
                'title' => 'image',
                'options' => [
                    'collapsed' => true
                ],
                'properties' => [
                    'title' => [
                        'type' => 'string',
                        'title' => 'Заголовок',
                        'default' => 'Новый DUSTER 4x4'
                    ],
                    'text' => [
                        'type' => 'string',
                        'title' => 'Текст',
                        'default' => 'Встречайте!'
                    ],
                    'link_href' => [
                        'type' => 'string',
                        'title' => 'Адреса посилання',
                        'default' => '#'
                    ],
                    'link_title' => [
                        'type' => 'string',
                        'title' => 'Текст посилання',
                        'default' => 'Узнать больше'
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
                    'alt_mobile' => [
                        'type' => 'string',
                        'title' => 'alt mobile',
                        'default' => 'alt mobile'
                    ],
                    'img_src_mobile' => [
                        'type' => 'string',
                        'format' => 'url',
                        'title' => 'Зображення для мобільного виду',
                        'options' => [
                            'upload' => true
                        ],
                        'links' => [
                            'href' => '{{self}}',
                            'rel' => 'View file'
                        ]
                    ]

                ]
            ]
        ];
        return $this->data;
    }
}