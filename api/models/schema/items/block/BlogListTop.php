<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 3:17 PM
 */

namespace api\models\schema\items\block;

use api\models\schema\base\Base;
use \Yii;

class BlogListTop extends Base
{

    public function __construct()
    {
        $this->wid    = 'bloglist-top';
        $this->wtitle = Yii::t('backend', 'BlogListTop');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["image"] = [

            "type"    => "string",
            "format"  => "url",
            "title"   => Yii::t('backend', 'image570х320'),
            "options" => [
                "upload" => true
            ],
            "links"   => [
                "href" => '{{self}}',
                "rel"  => "View file"
            ]
        ];

        $this->data['properties']["alt"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'alt'),
            "default" => "alt"
        ];

        $this->data['properties']["title"] = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'header'),
            "default" => "Усовершенствованная подвеска"
        ];

        $this->data['properties']["text"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'text'),
            "default" => 'Подвеска в новом Renault LOGAN не только сохранила все характеристики предшественника, но и подверглась некоторым доработкам. Так, мы увеличили жесткость пружин подвески и изменили стабилизатор поперечной устойчивости. Это позволило нам улучшить управляемость автомобиля и повысить комфорт и безопасность для вас и ваших пассажиров при маневрировании на высоких скоростях.'
        ];



        return $this->data;
    }
}
