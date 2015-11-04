<?php

namespace api\models\schema\items\text;

use api\models\schema\base\Base;
use \Yii;

class SectionText extends Base
{

    public function __construct()
    {
        $this->wid    = 'section-text';
        $this->wtitle = Yii::t('backend', 'SectionText');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {


        $this->data['properties']["header_1"] = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'Заголовок 1'),
            "default" => "Абсолютно новый. Абсолютно ЛОГАН"
        ];

        $this->data['properties']["header_2"] = [

            "type"    => "string",
            "title"   => Yii::t('backend', 'Заголовок 2'),
            "default" => "Новый Renault LOGAN"
        ];

        $this->data['properties']["text"] = [
            "type"    => "string",
            "title"   => Yii::t('backend', 'text'),
            "default" => "Долгожданный преемник Renault LOGAN предыдущего поколения, он унаследовал все его легендарные свойства: надежность, вместительность и безопасность. При этом автомобиль приобрел характерный яркий дизайн, современное оборудование и эргономичные решения в салоне."
        ];


        return $this->data;
    }
}