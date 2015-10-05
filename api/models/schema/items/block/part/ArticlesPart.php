<?php

namespace api\models\schema\items\block\part;

use api\models\schema\base\Base;

class ArticlesPart extends Base
{
    protected $wid    = 'articles-part';
    protected $wtitle = 'News part';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']['title']         = [
            'type'    => 'string',
            'title'   => 'Title.',
            'default' => 'НОВИНИ RENAULT',
        ];
        $this->data['properties']['all_news_text'] = [
            'type'    => 'string',
            'title'   => 'All news text.',
            'default' => 'ВСІ НОВИНИ RENAULT',
        ];
        $this->data['properties']['read_more']     = [
            'type'    => 'string',
            'title'   => 'Read more text',
            'default' => 'ЧИТАТИ ДАЛІ',
        ];
        $this->data['properties']['order_by']      = [
            'type'    => 'string',
            'title'   => 'Order by filed.',
            'enum'    => [
                '0' => 'id',
                '1' => 'weight',
                '2' => 'created_at',
                '3' => 'updated_at',
            ],
            'options' => [
                'enum_titles' => [
                    '0' => 'Id',
                    '1' => 'Weight',
                    '2' => 'Created at',
                    '3' => 'Updated at',
                ],
            ],
            'default' => 'id',
        ];
        $this->data['properties']['sort_order']    = [
            'type'    => 'string',
            'title'   => 'Sort order.',
            'enum'    => [
                '0' => 'asc',
                '1' => 'desc',
            ],
            'options' => [
                'enum_titles' => [
                    '0' => 'asc',
                    '1' => 'desc',
                ],
            ],
            'default' => 'desc',
        ];
        $this->data['properties']['count']         = [
            'type'    => 'string',
            'title'   => 'News count.',
            'default' => '3',
        ];

        return $this->data;
    }
}