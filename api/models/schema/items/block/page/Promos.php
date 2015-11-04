<?php

namespace api\models\schema\items\block\page;

use api\models\schema\base\Base;
use \Yii;

class Promos extends Base
{

    public function __construct()
    {
        $this->wid    = 'promos';
        $this->wtitle = Yii::t('backend', 'Promos list');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {
        //cusom code here
        $this->data['properties']['order_by']   = [
            'type'          => 'string',
            'propertyOrder' => '16',
            'title'         => Yii::t('backend', 'Order by filed.'),
            'enum'          => [
                '0' => 'id',
                '1' => 'weight',
                '2' => 'created_at',
                '3' => 'updated_at',
            ],
            'options'       => [
                'enum_titles' => [
                    '0' => 'Id',
                    '1' => 'Weight',
                    '2' => 'Created at',
                    '3' => 'Updated at',
                ],
            ],
            'default'       => 'id',
        ];
        $this->data['properties']['sort_order'] = [
            'type'          => 'string',
            'propertyOrder' => '17',
            'title'         => Yii::t('backend', 'Sort order.'),
            'enum'          => [
                '0' => 'asc',
                '1' => 'desc',
            ],
            'options'       => [
                'enum_titles' => [
                    '0' => 'asc',
                    '1' => 'desc',
                ],
            ],
            'default'       => 'desc',
        ];
        $this->data['properties']['count']      = [
            'type'          => 'string',
            'propertyOrder' => '18',
            'title'         => Yii::t('backend', 'Promos count.'),
            'default'       => '20',
        ];

        return $this->data;
    }
}