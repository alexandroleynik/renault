<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 7:49 PM
 */

namespace api\models\schema\items\image;

use api\models\schema\base\Base;
use common\models\Price;
use \Yii;

class Intro extends Base
{

    public function __construct()
    {
        $this->wid    = 'intro';
        $this->wtitle = Yii::t('backend', 'Intro');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["items"] = [
            "type"    => 'array',
            'title'   => Yii::t('backend', 'Intro'),
            'options' => [
                'collapsed' => true
            ],
            'items'   => [
                'type'       => 'object',
                'title'      => Yii::t('backend', 'image'),
                'options'    => [
                    'collapsed' => true
                ],
                'properties' => [
                    'title'          => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Заголовок'),
                        'default' => 'Новый DUSTER 4x4'
                    ],
                    'text'           => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Текст'),
                        'default' => 'Встречайте!'
                    ],
                    'price'          => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'price'),
                        'default' => 'Вiд 500000 грн!'
                    ],
                    'version_code'        => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Код версії'),
                        'enum' => Price::getAllVersionCodesEnum()
                    ],
                    'link_href'      => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Адреса посилання'),
                        'default' => '#'
                    ],
                    'link_title'     => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Текст посилання'),
                        'default' => 'Узнать больше'
                    ],
                    'alt'            => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'alt'),
                        'default' => 'alt'
                    ],
                    'img_src'        => [
                        'type'    => 'string',
                        'format'  => 'url',
                        'title'   => Yii::t('backend', 'imagePk1500x640'),
                        'options' => [
                            'upload' => true
                        ],
                        'links'   => [
                            'href' => '{{self}}',
                            'rel'  => 'View file'
                        ]
                    ],
                    'alt_mobile'     => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'alt mobile'),
                        'default' => 'alt mobile'
                    ],
                    'img_src_mobile' => [
                        'type'    => 'string',
                        'format'  => 'url',
                        'title'   => Yii::t('backend', 'image_mobile_960х1248'),
                        'options' => [
                            'upload' => true
                        ],
                        'links'   => [
                            'href' => '{{self}}',
                            'rel'  => 'View file'
                        ]
                    ]
                ]
            ]
        ];

        $this->data['properties']["footnote"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'footnote'),
            "default" => '* Цена включает стоимость доставки до дилерского центра...'
        ];
        
        return $this->data;
    }
}
