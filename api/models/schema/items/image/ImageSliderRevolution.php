<?php
/**
 * Created by PhpStorm.
 * User: viktor_
 * Date: 8/30/15
 * Time: 7:49 PM
 */

namespace api\models\schema\items\image;

use api\models\schema\base\Base;
use \Yii;

class ImageSliderRevolution extends Base
{

    public function __construct()
    {
        $this->wid    = 'image-slider-revolution';
        $this->wtitle = Yii::t('backend', 'Image slider revolution');

        parent::__construct($this->wid, $this->wtitle);
    }

    public function getData()
    {

        $this->data['properties']['items'] = [
            'type'    => 'array',
            'title'   => Yii::t('backend', 'Images for slider.'),
            'options' => [
                'collapsed' => true,
            ],
            'items'   => [
                'type'       => 'object',
                'title'      => Yii::t('backend', 'image'),
                'options'    => [
                    'collapsed' => true,
                ],
                'properties' => [
                    'title'            => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Title.'),
                        'default' => 'Lorem ipsum dolor sit amet.',
                    ],
                    'img_src'          => [
                        'type'    => 'string',
                        'format'  => 'url',
                        'title'   => Yii::t('backend', 'imagePk1500x640'),
                        'options' => [
                            'upload' => true,
                        ],
                        'links'   => [
                            '0' => [
                                'href' => '{{self}}',
                                'rel'  => 'View file',
                            ],
                        ],
                    ],
                    'img_src_mob'      => [
                        'type'    => 'string',
                        'format'  => 'url',
                        'title'   => Yii::t('backend', 'image_mobile_960х1248'),
                        'options' => [
                            'upload' => true,
                        ],
                        'links'   => [
                            '0' => [
                                'href' => '{{self}}',
                                'rel'  => 'View file',
                            ],
                        ],
                    ],
                    'header-1'         => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'header-1'),
                        'default' => 'ALL-NEW
KADJAR',
                    ],
                    'header-2'         => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'header-2'),
                        'default' => 'Dare to live',
                    ],
                    'header-3'         => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'header-3'),
                        'default' => 'With £5,060 deposit contribution.',
                    ],
                    'button-1'         => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'button-1'),
                        'default' => 'Explore KADJAR',
                    ],
                    'urlButton-1'      => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'urlButton-1'),
                        'default' => '#',
                    ],
                    'button-2'         => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'button-2'),
                        'default' => 'Register your interest',
                    ],
                    'urlButton-2'      => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'urlbutton-2'),
                        'default' => '#',
                    ],
                    'Flat_Transitions' => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'Flat Transitions'),
                        'enum'    => [
                            '0'  => 'slideup',
                            '1'  => 'slidedown',
                            '2'  => 'slideright',
                            '3'  => 'slideleft',
                            '4'  => 'slidehorizontal',
                            '5'  => 'slidevertical',
                            '6'  => 'boxslide',
                            '7'  => 'slotslide-horizontal',
                            '8'  => 'slotslide-vertical',
                            '9'  => 'boxfade',
                            '10' => 'slotfade-horizontal',
                            '11' => 'slotfade-vertical',
                            '12' => 'fadefromright',
                            '13' => 'fadefromleft',
                            '14' => 'fadefromtop',
                            '15' => 'fadefrombottom',
                            '16' => 'fadetoleftfadefromright',
                            '17' => 'fadetorightfadefromleft',
                            '18' => 'fadetotopfadefrombottom',
                            '19' => 'fadetobottomfadefromtop',
                            '20' => 'parallaxtoright',
                            '21' => 'parallaxtoleft',
                            '22' => 'parallaxtotop',
                            '23' => 'parallaxtobottom',
                            '24' => 'scaledownfromright',
                            '25' => 'scaledownfromleft',
                            '26' => 'scaledownfromtop',
                            '27' => 'scaledownfrombottom',
                            '28' => 'zoomout',
                            '29' => 'zoomin',
                            '30' => 'slotzoom-horizontal',
                            '31' => 'slotzoom-vertical',
                            '32' => 'fade',
                            '33' => 'random-static',
                            '34' => 'random',
                        ],
                        'options' => [
                            'hidden'      => 'true',
                            'enum_titles' => [
                                '0'  => 'Slide To Top',
                                '1'  => 'Slide To Bottom',
                                '2'  => 'Slide To Right',
                                '3'  => 'Slide To Left',
                                '4'  => 'Slide Horizontal (depending on Next/Previous)',
                                '5'  => 'Slide Vertical (depending on Next/Previous)',
                                '6'  => 'Slide Boxes',
                                '7'  => 'Slide Slots Horizontal',
                                '8'  => 'Slide Slots Vertical',
                                '9'  => 'Fade Boxes',
                                '10' => 'Fade Slots Horizontal',
                                '11' => 'Fade Slots Vertical',
                                '12' => 'Fade and Slide from Right',
                                '13' => 'Fade and Slide from Left',
                                '14' => 'Fade and Slide from Top',
                                '15' => 'Fade and Slide from Bottom',
                                '16' => 'Fade To Left and Fade From Right',
                                '17' => 'Fade To Right and Fade From Left',
                                '18' => 'Fade To Top and Fade From Bottom',
                                '19' => 'Fade To Bottom and Fade From Top',
                                '20' => 'Parallax to Right',
                                '21' => 'Parallax to Left',
                                '22' => 'Parallax to Top',
                                '23' => 'Parallax to Bottom',
                                '24' => 'Zoom Out and Fade From Right',
                                '25' => 'Zoom Out and Fade From Left',
                                '26' => 'Zoom Out and Fade From Top',
                                '27' => 'Zoom Out and Fade From Bottom',
                                '28' => 'ZoomOut',
                                '29' => 'ZoomIn',
                                '30' => 'Zoom Slots Horizontal',
                                '31' => 'Zoom Slots Vertical',
                                '32' => 'Fade',
                                '33' => 'Random Flat',
                                '34' => 'Random Flat and Premium',
                            ],
                        ],
                        'default' => 'fade',
                    ],
                    'inc'              => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'INCOMING ANIMATION CLASSES'),
                        'enum'    => [
                            '0'  => 'sft',
                            '1'  => 'sfb',
                            '2'  => 'sfr',
                            '3'  => 'sfl',
                            '4'  => 'lft',
                            '5'  => 'lfb',
                            '6'  => 'lfr',
                            '7'  => 'lfl',
                            '8'  => 'skewfromleft',
                            '9'  => 'skewfromright',
                            '10' => 'skewfromleftshort',
                            '11' => 'skewfromrightshort',
                            '12' => 'fade',
                            '13' => 'randomrotate',
                        ],
                        'options' => [
                            'hidden'      => 'true',
                            'enum_titles' => [
                                '0'  => 'Short from Top',
                                '1'  => 'Short from Bottom',
                                '2'  => 'Short from Right',
                                '3'  => 'Short from Left',
                                '4'  => 'Long from Top',
                                '5'  => 'Long from Bottom',
                                '6'  => 'Long from Right',
                                '7'  => 'Long from Left',
                                '8'  => 'Skew from Left',
                                '9'  => 'Skew from Right',
                                '10' => 'Skew Short from Left',
                                '11' => 'Skew Short from Right',
                                '12' => 'fading',
                                '13' => 'Fade in, Rotate from a Random position and Degree',
                            ],
                        ],
                        'default' => 'randomrotate',
                    ],
                    'out'              => [
                        'type'    => 'string',
                        'title'   => Yii::t('backend', 'OUTGOING ANIMATION CLASSES'),
                        'enum'    => [
                            '0'  => 'sft',
                            '1'  => 'sfb',
                            '2'  => 'sfr',
                            '3'  => 'sfl',
                            '4'  => 'lft',
                            '5'  => 'lfb',
                            '6'  => 'lfr',
                            '7'  => 'lfl',
                            '8'  => 'skewfromleft',
                            '9'  => 'skewfromright',
                            '10' => 'skewfromleftshort',
                            '11' => 'skewfromrightshort',
                            '12' => 'fade',
                            '13' => 'randomrotate',
                        ],
                        'options' => [
                            'hidden'      => 'true',
                            'enum_titles' => [
                                '0'  => 'Short from Top',
                                '1'  => 'Short from Bottom',
                                '2'  => 'Short from Right',
                                '3'  => 'Short from Left',
                                '4'  => 'Long from Top',
                                '5'  => 'Long from Bottom',
                                '6'  => 'Long from Right',
                                '7'  => 'Long from Left',
                                '8'  => 'Skew from Left',
                                '9'  => 'Skew from Right',
                                '10' => 'Skew Short from Left',
                                '11' => 'Skew Short from Right',
                                '12' => 'fading',
                                '13' => 'Fade in, Rotate from a Random position and Degree',
                            ],
                        ],
                        'default' => 'randomrotate',
                    ],
                ],
            ],
        ];

        return $this->data;
    }
}
