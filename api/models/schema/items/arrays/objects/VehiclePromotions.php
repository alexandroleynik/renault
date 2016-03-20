<?php

namespace api\models\schema\items\arrays\objects;

use api\models\schema\base\Base;
use common\models\Price;
use \Yii;

class VehiclePromotions extends Base
{

    public function __construct()
    {
        $this->wid    = 'vehicle-promotions';
        $this->wtitle = Yii::t('backend', 'Vehicle promotions');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']['title']         = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Title.'),
            'default' => 'ОБЕРІТЬ СВІЙ RENAULT',
        ];
        $this->data['properties']['show_all_text'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Show all text.'),
            'default' => 'ВСІ МОДЕЛІ RENAULT',
        ];
        $this->data['properties']['items']         = [
            'type'    => 'array',
            'title'   => Yii::t('backend', 'Vehicle list'),
            'options' => [
                'collapsed' => true,
            ],
            'items'   => [
                'type'       => 'object',
                'title'      => Yii::t('backend', 'Vehicle'),
                'options'    => [
                    'collapsed' => true,
                ],
                'properties' => [
                    'title'                 => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Title.'),
                        'default' => 'Lorem ipsum dolor sit amet.',
                    ],
                    'start_price'           => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Start price.'),
                        'default' => 'От 99999 грн',
                    ],
                    'version_code'        => Price::getAllVersionCodesEnum(),
                    'img_src'               => [
                        'type'    => 'string',
                        'format'  => 'url',
                        'title'   => Yii::t('backend', 'image320х200'),
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
                    'alt'                   => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Alt'),
                        'default' => 'renault ',
                    ],
                    'details_url'           => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Details url'),
                        'default' => '#',
                    ],
                    'details_text'          => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Details text'),
                        'default' => 'Детальнiше',
                    ],
                    'Download_Brochure_url' => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Завантажити брошуру url'),
                        'default' => '#',
                    ],
                    'Download_Brochure'     => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Завантажити брошуру text'),
                        'default' => 'Завантажити брошуру',
                    ],
                ],
            ],
        ];

        return $this->data;
    }
}
