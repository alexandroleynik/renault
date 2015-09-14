<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 3:17 PM
 */

namespace api\models\schema\items\block\engine;


use api\models\schema\base\Base;

class Engine extends Base
{
    protected $wid = 'engine';
    protected $wtitle = 'Engine';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["title"] = [

            "type" => "string",
            "title" => "Заголовок",
            "default" => "ВЫБЕРИТЕ ПОДХОДЯЩИЙ ВАМ ДВИГАТЕЛЬ"
        ];

        $this->data['properties']["items"] = [

            "type" => "array",

            "title" => "Двигуни",
            "uniqueItems" => true,
            "options" => [
                "collapsed" => true
            ],
            "items" => [
                "type" => "object",
                "title" => "Двигун",
                "properties" => [
                    "name" => [
                        "type" => "string",
                        "title" => "Назва",
                        "default" => "НОВЫЙ ТУРБОДИЗЕЛЬ 1.5DCI 109 Л. С.",
                        "options" => [
                            "input_width" => "400px"
                        ]
                    ],
                    "image" => [

                        "type" => "string",
                        "format" => "url",
                        "title" => "Зображення",
                        "options" => [
                            "upload" => true
                        ],
                        "links" => [
                            "href" => '{{self}}',
                            "rel" => "View file"
                        ]
                    ],
                    "alt" => [
                        "type" => "string",
                        "title" => "alt",
                        "default" => "alt"
                    ],

                    "text" => [
                        "type"    => "string",
                        "format"  => "html",
                        "options" => [
                            "wysiwyg" => true
                        ],
                        "title"   => "Опис",
                        "default" => "Lorem ipsum dolor sit amet, consectetur adipiscing."
                    ]
                ]
            ]
        ];


        return $this->data;
    }
}