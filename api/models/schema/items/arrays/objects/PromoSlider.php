<?php

namespace api\models\schema\items\arrays\objects;

use api\models\schema\base\Base;
use \Yii;

class PromoSlider extends Base
{
    protected $wid    = 'promo-slider';
    protected $wtitle = 'Slider';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']['img_src'] = [
            'type'    => 'string',
            'format'  => 'url',
            'title' => Yii::t('backend', 'Main image.'),
            'options' => [
                'upload' => true,
            ],
            'links'   => [
                '0' => [
                    'href' => '{{self}}',
                    'rel'  => 'View file',
                ],
            ],
        ];
        $this->data['properties']['items']   = [
            'type'    => 'array',
            'title' => Yii::t('backend', 'Images for slider.'),
            'options' => [
                'collapsed' => true,
            ],
            'items'   => [
                'type'       => 'object',
                'title' => Yii::t('backend', 'image'),
                'options'    => [
                    'collapsed' => true,
                ],
                'properties' => [
                    'title'   => [
                        'type'    => 'string',
                        'title' => Yii::t('backend', 'Title.'),
                        'default' => 'Lorem ipsum dolor sit amet.',
                    ],
                    'img_src' => [
                        'type'    => 'string',
                        'format'  => 'url',
                        'title' => Yii::t('backend', 'Some image.'),
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