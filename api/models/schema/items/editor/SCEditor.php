<?php

namespace api\models\schema\items\editor;

use api\models\schema\base\Base;
use \Yii;

class SCEditor extends Base
{

    public function __construct()
    {
        $this->wid    = 'sceditor';
        $this->wtitle = Yii::t('backend', 'Wysiwyg editor');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
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