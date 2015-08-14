<?php

namespace api\models\schema\items\editor;

use api\models\schema\base\Base;

class SCEditor extends Base
{
    protected $wid    = 'sceditor';
    protected $wtitle = 'Wysiwyg editor';

    public function __construct()
    {
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
            "title"   => "Text.",
            "default" => "Lorem ipsum dolor sit amet, consectetur adipiscing."
        ];

        return $this->data;
    }
}