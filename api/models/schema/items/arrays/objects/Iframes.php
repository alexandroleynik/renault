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

class Iframes extends Base
{

    public function __construct()
    {
        $this->wid    = 'iframes';
        $this->wtitle = Yii::t('backend', 'Iframes');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {



        $this->data['properties']["items"] = [

            "type" => "array",
            "title"   => Yii::t('backend', 'Frames'),
            "options" => [
                "collapsed" => true
            ],
            "items"   => [
                "type"        => "object",
                "title"       => Yii::t('backend', 'frame'),
                "uniqueItems" => false,
                "properties"  => [
                    "frame" => [
                        "type"  => "string",
                        "title" => Yii::t('backend', 'frame'),
                    ],
                ]]
        ];




        return $this->data;
    }
}