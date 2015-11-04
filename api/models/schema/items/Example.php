<?php

namespace api\models\schema\items;

use api\models\schema\base\Base;
use \Yii;

class Example extends Base
{

    public function __construct()
    {
        $this->wid    = 'example';
        $this->wtitle = Yii::t('backend', 'Example');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']['wysiwyg']     = [
            'type'    => 'string',
            'format'  => 'html',
            'options' => [
                'wysiwyg' => true,
            ],
            'title'   => Yii::t('backend', 'Text.'),
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing.',
        ];
        $this->data['properties']['multiselect'] = [
            'type'        => 'array',
            'uniqueItems' => true,
            'format'      => 'select',
            '$ref'        => '/member/enum',
        ];
        $this->data['properties']['upload']      = [
            'type'    => 'string',
            'format'  => 'url',
            'title'   => Yii::t('backend', 'Some image.'),
            'options' => [
                'upload' => true,
            ],
            'links'   => [
                '0' => [
                    'href' => '{{self}}',
                    'rel'  => 'View file',
                ],
            ],
        ];
        $this->data['properties']['title']       = [
            'type'    => 'string',
            'title'   => Yii::t('backend', 'Title'),
            'default' => 'Lorem ipsum dolor sit amet',
        ];

        return $this->data;
    }
}