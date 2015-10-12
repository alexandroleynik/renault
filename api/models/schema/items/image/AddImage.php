<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 7:49 PM
 */

namespace api\models\schema\items\image;

use api\models\schema\base\Base;
use \Yii;

class AddImage extends Base
{
    protected $wid    = 'add-image';
    protected $wtitle = 'Add image';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["image"] = [
            "type"    => "string",
            "format"  => "url",
            "title"   => Yii::t('backend', 'Some image.'),
            "options" => [
                "upload" => true
            ],
            "links"   => [
                [
                    "href" => "{{self}}",
                    "rel"  => "View file"
                ]
            ]
        ];

        $this->data['properties']["alt"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'alt'),
            "default" => "alt"
        ];
        $this->data['properties']["alt"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'Title'),
            "default" => "Lorem ipsum dolor sit amet"
        ];

        return $this->data;
    }
}