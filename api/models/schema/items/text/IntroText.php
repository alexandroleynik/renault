<?php

namespace api\models\schema\items\text;

use api\models\schema\base\Base;
use \Yii;

class IntroText extends Base
{
    protected $wid = 'intro-text';
    protected $wtitle = 'IntroText';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']["header"] = [

            "type" => "string",
            "title" => Yii::t('backend', 'header'),
            "default" => "Внешний дизайн"
        ];

        $this->data['properties']["text"] = [
            "type" => "string",
            "title" => Yii::t('backend', 'text'),
            "default" => "Обновленный дизайн Renault LOGAN удивит вас своей простотой и элегантностью. Классические формы седана, четкие горизонтальные линии и ярко выделенные колесные арки создают современный и динамичный образ, открывая новую эру дизайна в своем сегменте."
        ];


        return $this->data;
    }
}
