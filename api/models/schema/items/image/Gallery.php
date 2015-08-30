<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 7:49 PM
 */

namespace api\models\schema\items\image;

use api\models\schema\base\Base;

class Gallery extends Base
{

    protected $wid = 'gallery';
    protected $wtitle = 'Gallery';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["items"] = [
            "type" => 'array',
            'title' => 'Gallery',
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
                        'title' => 'Title',
                        'default' => 'Lorem ipsum dolor sit amet.'
                    ],
                    'alt' => [
                        'type' => 'string',
                        'title' => 'alt',
                        'default' => 'alt'
                    ],
                    'img_src' => [
                        'type' => 'string',
                        'format' => 'url',
                        'title' => 'Some image.',
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