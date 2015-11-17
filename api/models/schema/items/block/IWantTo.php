<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 3:17 PM
 */

namespace api\models\schema\items\block;

use api\models\schema\base\Base;
use \Yii;

class IWantTo extends Base
{

    public function __construct()
    {
        $this->wid    = 'i-want-to';
        $this->wtitle = Yii::t('backend', 'I want to');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        $this->data['properties']['i_want_to_text'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'I want to text'),
            'default' => 'Я хотiв би',
        ];
        $this->data['properties']["buttons"]        = [
            "type"     => "array",
            "title"    => Yii::t('backend', "Buttons"),
            "maxItems" => '6',
            "items"    => [
                "type"       => "object",
                "title"      => Yii::t('backend', "button"),
                "format"     => 'grid',
                "properties" => [
                    "image" => [
                        "type"          => "string",
                        "format"        => "url",
                        "title"         => Yii::t('backend', 'icon35х35'),
                        "propertyOrder" => 1,
                        "options"       => [
                            "upload"       => true,
                            'grid_columns' => 12,
                            "input_width"  => "300px"
                        ],
                        "links"         => [
                            [
                                "href" => "{{self}}",
                                "rel"  => "View file"
                            ]
                        ]
                    ],
                    "name"  => [
                        "type"          => "string",
                        'title'         => Yii::t('backend', 'name'),
                        "default"       => "name",
                        "propertyOrder" => 10,
                        'options'       => [
                            'grid_columns' => 4
                        ]
                    ],
                    "host"  => [
                        'type'          => 'string',
                        'propertyOrder' => 20,
                        'title'         => Yii::t('backend', 'host'),
                        'enum'          => [
                            '0' => '',
                            '1' => '@frontend',
                        ],
                        'options'       => [
                            'grid_columns' => 4,
                            'enum_titles'  => [
                                '0' => 'Зовнішній сайт',
                                '1' => '@frontend',
                            ],
                        ],
                        'default'       => '@frontend',
                    ],
                    "url"   => [
                        'title'         => Yii::t('backend', 'url'),
                        "type"          => "string",
                        "propertyOrder" => 30,
                        'options'       => [
                            'grid_columns' => 4
                        ]
                    ],
                ]
            ],
        ];
        return $this->data;
    }
}
