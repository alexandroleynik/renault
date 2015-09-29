<?php

namespace api\models\schema\items;

use api\models\schema\base\Base;

class Example extends Base
{
    protected $wid    = 'example';
    protected $wtitle = 'Example';

    public function __construct()
    {
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
            'title'   => 'Text.',
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
            'title'   => 'Some image.',
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
            'title'   => 'Title',
            'default' => 'Lorem ipsum dolor sit amet',
        ];

        return $this->data;
    }
}