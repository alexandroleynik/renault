<?php

namespace api\models\schema\items\text;

use api\models\schema\base\Base;
use \Yii;

class PromoTitle extends Base
{

    public function __construct()
    {
        $this->wid    = 'promo-title';
        $this->wtitle = Yii::t('backend', 'Title');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']['title'] = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Title'),
            'default' => 'Lorem ipsum dolor sit amet',
        ];


        return $this->data;
    }
}