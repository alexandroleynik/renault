<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 3:17 PM
 */

namespace api\models\schema\items\block;

use api\models\schema\base\Base;

class Social extends Base
{
    protected $wid    = 'social';
    protected $wtitle = 'Social';

    public function __construct()
    {
        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']['title']          = [
            'type'    => 'string',
            'title'   => 'Title',
            'default' => 'RENAULT В СОЦИАЛЬНЫХ СЕТЯХ',
        ];
        $this->data['properties']['FbTitle']        = [
            'type'    => 'string',
            'title'   => 'Facebook Title',
            'default' => 'Renault Украина',
        ];
        $this->data['properties']['YtTitle']        = [
            'type'    => 'string',
            'title'   => 'Youtube Title',
            'default' => 'Renault Украина',
        ];
        $this->data['properties']['instTitle']      = [
            'type'    => 'string',
            'title'   => 'Instagram Title',
            'default' => 'Renault Украина Instagram',
        ];
        $this->data['properties']['load_more_text'] = [
            'type'    => 'string',
            'title'   => 'Title',
            'default' => 'ЗАВАНТАЖИТИ БІЛЬШЕ',
        ];
        $this->data['properties']['wordSlice']      = [
            'type'    => 'number',
            'title'   => 'slice message (number of words)',
            'default' => '20',
        ];


        return $this->data;
    }
}