<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 3:17 PM
 */

namespace api\models\schema\items\arrays\objects;


use api\models\schema\base\Base;
class Iframes extends Base{
    protected $wid = 'iframes';
    protected $wtitle = 'Iframes';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {



        $this->data['properties']["items"] = [

            "type" => "array",

            "title" => "Frames",
            "options" => [
                "collapsed" => true
            ],
            "items" => [
                "type" => "object",
                "title" => "frame",
                "uniqueItems" => false,
                "properties" => [
                    "frame" => [
                        "type" => "string",
                        "title" => "frame",

                    ],



                ]]

        ];




        return $this->data;
    }
}