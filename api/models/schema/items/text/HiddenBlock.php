<?php

namespace api\models\schema\items\text;

use api\models\schema\base\Base;
use \Yii;

class HiddenBlock extends Base
{

    public function __construct()
    {
        $this->wid    = 'hidden-block';
        $this->wtitle = Yii::t('backend', 'HiddenBlock');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["header"] = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'header'),
            "default" => "Header"
        ];

        $this->data['properties']["text"] = [
            "type"    => "string",
            "format"  => "html",
            "options" => [
                "wysiwyg" => true
            ],
            "title"   => Yii::t('backend', 'Text.'),
            "default" => "Lorem ipsum dolor sit amet, consectetur adipiscing."
        ];


        return $this->data;
    }
}
