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

    public function __construct()
    {
        $this->wid    = 'add-image';
        $this->wtitle = Yii::t('backend', 'Add image');

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

        $this->data['properties']["alt"]   = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'alt'),
            "default" => "alt"
        ];
        $this->data['properties']["title"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'Title'),
            "default" => "Lorem ipsum dolor sit amet"
        ];

        $this->data['properties']["add-image-title"]          = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'add image title'),
            "default" => "add-image-title",
            "options" => [
                "hidden" => true
            ],
        ];

        return $this->data;
    }
}