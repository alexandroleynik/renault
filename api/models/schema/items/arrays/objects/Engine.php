<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 3:17 PM
 */

namespace api\models\schema\items\arrays\objects;

use api\models\schema\base\Base;
use \Yii;

class Engine extends Base
{

    public function __construct()
    {
        $this->wid    = 'engine';
        $this->wtitle = Yii::t('backend', 'Engine');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["title"] = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'Заголовок'),
            "default" => "ВЫБЕРИТЕ ПОДХОДЯЩИЙ ВАМ ДВИГАТЕЛЬ"
        ];

        $this->data['properties']["items"] = [

            "type" => "array",
            "title"       => Yii::t('backend', 'Двигуни'),
            "uniqueItems" => true,
            "options"     => [
                "collapsed" => true
            ],
            "items"       => [
                "type"       => "object",
                "title"      => Yii::t('backend', 'Двигун'),
                "properties" => [
                    "name"  => [
                        "type"    => "string",
                        "title"   => Yii::t('backend', 'Назва'),
                        "default" => "НОВЫЙ ТУРБОДИЗЕЛЬ 1.5DCI 109 Л. С.",
                        "options" => [
                            "input_width" => "400px"
                        ]
                    ],
                    "image" => [

                        "type"    => "string",
                        "format"  => "url",
                        "title"   => Yii::t('backend', 'image585х328'),
                        "options" => [
                            "upload" => true
                        ],
                        "links"   => [
                            "href" => '{{self}}',
                            "rel"  => "View file"
                        ]
                    ],
                    "alt"   => [
                        "type"    => "string",
                        "title"   => Yii::t('backend', 'alt'),
                        "default" => "alt"
                    ],
                    "text" => [
                        "type"    => "string",
                        "format"  => "html",
                        "options" => [
                            "wysiwyg" => true
                        ],
                        "title"   => Yii::t('backend', 'Опис'),
                        "default" => "Lorem ipsum dolor sit amet, consectetur adipiscing."
                    ]
                ]
            ]
        ];


        return $this->data;
    }
}
