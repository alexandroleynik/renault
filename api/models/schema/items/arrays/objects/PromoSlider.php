<?php

namespace api\models\schema\items\arrays\objects;

use api\models\schema\base\Base;
use \Yii;

class PromoSlider extends Base
{

    public function __construct()
    {
        $this->wid    = 'promo-slider';
        $this->wtitle = Yii::t('backend', 'Slider');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']['img_src'] = [
            'type'    => 'string',
            'format'  => 'url',
            'title'   => Yii::t('backend', 'Main image.'),
            'options' => [
                'upload' => true,
                "hidden" => true
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
            'title'   => Yii::t('backend', 'Images for slider.'),
            'options' => [
                'collapsed' => true,
            ],
            'items'   => [
                'type'       => 'object',
                'title'      => Yii::t('backend', 'image'),
                'options'    => [
                    'collapsed' => true,
                ],
                'properties' => [
                    'title'   => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Title.'),
                        'default' => 'Lorem ipsum dolor sit amet.',
                    ],
                    'img_src' => [
                        'type'    => 'string',
                        'format'  => 'url',
                        'title'   => Yii::t('backend', 'image730'),
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
