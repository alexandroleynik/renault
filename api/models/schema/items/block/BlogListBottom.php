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

class BlogListBottom extends Base
{

    public function __construct()
    {
        $this->wid    = 'bloglist-bottom';
        $this->wtitle = Yii::t('backend', 'BlogListBottom');

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
            "default" => "Адаптация к климатическим условиям"
        ];

        $this->data['properties']["text"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'text'),
            "default" => '<p>Новый Renault LOGAN великолепно подготовлен к российским климатическим условиям:</p>'
            . '<ul>'
            . '<li>- Обогрев лобового стекла и подогрев передних сидений</li>'
            . '<li>- Запуск двигателя в холодном климате</li>'
            . '<li>- Адаптация технических жидкостей к эксплуатации при низких температурах</li>'
            . '<li>- АКБ увеличенной емкости</li>'
            . '</ul>'
        ];



        return $this->data;
    }
}
