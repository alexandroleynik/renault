<?php

namespace api\models\schema\base;

use \Yii;

/**
 * Description of Base
 *
 * @author Eugene Fabrikov <eugene.fabrikov@gmail.com>
 */
class HeadBase
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            "title"      => Yii::t('backend', 'Head'),
            "type"       => "object",
            "id"         => "head",            
            "options"    => [
                "collapsed" => true
            ],
            "properties" => [
                "common"    => [
                    "type"       => "object",
                    "title"      => Yii::t('backend', 'Common'),
                    "options"    => [
                        "collapsed" => true
                    ],
                    "properties" => [
                        "title"       => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "name"    => [
                                    "type"    => "string",
                                    "default" => "title"
                                ],
                                "content" => [
                                    "type"    => "string",
                                    "default" => Yii::$app->name
                                ]
                            ]
                        ],
                        "description" => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "name"    => [
                                    "type"    => "string",
                                    "default" => "description"
                                ],
                                "content" => [
                                    "type"    => "string",
                                    "default" => Yii::$app->name
                                ]
                            ]
                        ],
                        "image"       => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "name"    => [
                                    "type"    => "string",
                                    "default" => "image"
                                ],
                                "content" => [
                                    "type"    => "string",
                                    "format"  => "url",
                                    "title"   => Yii::t('backend', 'Some image.'),
                                    "default" => Yii::getAlias('@frontendUrl') . '/img/og_image.jpg',
                                    "options" => [
                                        "upload" => true
                                    ],
                                    "links"   => [
                                        [
                                            "href" => "{{self}}",
                                            "rel"  => "View file"
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                "facebook"  => [
                    "type"       => "object",
                    "title"      => "Facebook",
                    "options"    => [
                        "collapsed" => true
                    ],
                    "properties" => [
                        "title"       => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "property" => [
                                    "type"    => "string",
                                    "default" => "ogtitle"
                                ],
                                "content"  => [
                                    "type"        => "string",
                                    "description" => "This is generated automatically from the common title field",
                                    "template"    => "{{title}}",
                                    "watch"       => [
                                        "title" => "head.common.title.content"
                                    ]
                                ]
                            ]
                        ],
                        "description" => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "property" => [
                                    "type"    => "string",
                                    "default" => "og=>description"
                                ],
                                "content"  => [
                                    "type"        => "string",
                                    "description" => "This is generated automatically from the common description field",
                                    "template"    => "{{description}}",
                                    "watch"       => [
                                        "description" => "head.common.description.content"
                                    ]
                                ]
                            ]
                        ],
                        "image"       => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "property" => [
                                    "type"    => "string",
                                    "default" => "og=>image"
                                ],
                                "content"  => [
                                    "type"        => "string",
                                    "description" => "This is generated automatically from the common image field",
                                    "template"    => "{{image}}",
                                    "watch"       => [
                                        "image" => "head.common.image.content"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                "twitter"   => [
                    "type"       => "object",
                    "title"      => "Twitter",
                    "options"    => [
                        "collapsed" => true
                    ],
                    "properties" => [
                        "title"       => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "name"    => [
                                    "type"    => "string",
                                    "default" => "twitter=>title"
                                ],
                                "content" => [
                                    "type"        => "string",
                                    "description" => "This is generated automatically from the common title field",
                                    "template"    => "{{title}}",
                                    "watch"       => [
                                        "title" => "head.common.title.content"
                                    ]
                                ]
                            ]
                        ],
                        "description" => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "name"    => [
                                    "type"    => "string",
                                    "default" => "twitter=>description"
                                ],
                                "content" => [
                                    "type"        => "string",
                                    "description" => "This is generated automatically from the common description field",
                                    "template"    => "{{description}}",
                                    "watch"       => [
                                        "description" => "head.common.description.content"
                                    ]
                                ]
                            ]
                        ],
                        "image"       => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "name"    => [
                                    "type"    => "string",
                                    "default" => "twitter=>image=>src"
                                ],
                                "content" => [
                                    "type"        => "string",
                                    "description" => "This is generated automatically from the common image field",
                                    "template"    => "{{image}}",
                                    "watch"       => [
                                        "image" => "head.common.image.content"
                                    ]
                                ]
                            ]
                        ],
                        "card"        => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "name"    => [
                                    "type"    => "string",
                                    "default" => "twitter=>card"
                                ],
                                "content" => [
                                    "type"    => "string",
                                    "default" => "summary"
                                ]
                            ]
                        ]
                    ]
                ],
                "vkontakte" => [
                    "type"       => "object",
                    "title"      => "Vkontakte",
                    "options"    => [
                        "collapsed" => true
                    ],
                    "properties" => [
                        "title"       => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "name"    => [
                                    "type"    => "string",
                                    "default" => "title"
                                ],
                                "content" => [
                                    "type"        => "string",
                                    "description" => "This is generated automatically from the common title field",
                                    "template"    => "{{title}}",
                                    "watch"       => [
                                        "title" => "head.common.title.content"
                                    ]
                                ]
                            ]
                        ],
                        "description" => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "name"    => [
                                    "type"    => "string",
                                    "default" => "description"
                                ],
                                "content" => [
                                    "type"        => "string",
                                    "description" => "This is generated automatically from the common description field",
                                    "template"    => "{{description}}",
                                    "watch"       => [
                                        "description" => "head.common.description.content"
                                    ]
                                ]
                            ]
                        ],
                        "image"       => [
                            "type"       => "object",
                            "format"     => "grid",
                            "options"    => [
                                "collapsed" => true
                            ],
                            "properties" => [
                                "rel"  => [
                                    "type"    => "string",
                                    "default" => "image_src"
                                ],
                                "href" => [
                                    "type"        => "string",
                                    "description" => "This is generated automatically from the common image field",
                                    "template"    => "{{image}}",
                                    "watch"       => [
                                        "image" => "head.common.image.content"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                "custom"    => [
                    "type"        => "array",
                    "format"      => "table",
                    "title"       => Yii::t('backend', "Custom"),
                    "uniqueItems" => true,
                    "options"     => [
                        "collapsed" => true
                    ],
                    "items"       => [
                        "type"       => "object",
                        "properties" => [
                            "name_key"      => [
                                "type"  => "string",
                                "title" => Yii::t('backend', 'Name key')
                            ],
                            "name_value"    => [
                                "type"  => "string",
                                "title" => Yii::t('backend', 'Name value')
                            ],
                            "content_key"   => [
                                "type"  => "string",
                                "title" => Yii::t('backend', 'Content key')
                            ],
                            "content_value" => [
                                "type"  => "string",
                                "title" => Yii::t('backend', 'Content value')
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function getData()
    {
        return $this->data;
    }
}