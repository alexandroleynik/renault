<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 3:17 PM
 */

namespace api\models\schema\items\block\engine;


use api\models\schema\base\Base;
class Engine extends Base{
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

            "title" => "Credit",

            "options" => [
                "collapsed" => true
            ],
            "engine" => [
                "type" => "string",
                "title" => "engine",
                ]
            ];



        return $this->data;
    }
}