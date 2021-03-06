<?php
namespace api\models\schema\items\arrays\tables;
use api\models\schema\base\Base;
use \Yii;
class Breadcrumbs extends Base
{
    public function __construct()
    {
        $this->wid    = 'breadcrumbs';
        $this->wtitle = Yii::t('backend', 'Breadcrumbs');
        parent::__construct($this->wid, $this->wtitle);
    }
    public function getData()
    {
        //cusom code here
        $this->data['properties']['t']["options"]["hidden"] = false;
        $this->data['properties']['links']["options"]["hidden"] = false;
        $this->data['properties']["items"] = [
            "type"        => "array",
            "format"      => "table",
            "title"       => Yii::t('backend', 'Breadcrumbs'),
            "uniqueItems" => true,
            "options"     => [
                "collapsed" => true
            ],
            "items"       => [
                "title"      => Yii::t('backend', 'item'),
                "type"       => "object",
                "properties" => [
                    "breadcrumbs"  => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "400px"
                        ]
                    ],
                    "title" => [
                        "type"    => "string",
                        "options" => [
                            "input_width" => "300px"
                        ]
                    ]
                ]
            ]
        ];
        return $this->data;
    }
}
