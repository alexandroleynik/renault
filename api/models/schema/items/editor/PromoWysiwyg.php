<?php

namespace api\models\schema\items\editor;

use api\models\schema\base\Base;

class PromoWysiwyg extends Base
{
    protected $wid    = 'promo-wysiwyg';
    protected $wtitle = 'Promo Wysiwyg';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']['text'] = [
            'type'    => 'string',
            'format'  => 'html',
            'options' => [
                'wysiwyg' => true,
            ],
            'title'   => 'Text.',
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing.',
        ];

        return $this->data;
    }
}