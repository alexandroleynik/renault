<?php

namespace api\models\schema\root\info\head;
use \Yii;

class Schema
{
    private $data = [];

    public function getData()
    {
        $this->data = [
            "title"      => "Head",
            "type"       => "object",
            "id"         => "head",
            "options"    => [
                "collapsed" => true
            ],
            "properties" => [
                "common"    => [
                    "type"       => "object",
                    "title"      => "Common",
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
                                    "title"   => "Some image.",
                                    "default" => Yii::getAlias('@frontendUrl') . '/img/og_image.ico',
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
                                    "default" => "og=>title"
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
                    "title"       => "Custom",
                    "uniqueItems" => true,
                    "options"     => [
                        "collapsed" => true
                    ],
                    "items"       => [
                        "type"       => "object",
                        "properties" => [
                            "name_key"    => [
                                "type" => "string",
                                "title" => "Name key"
                            ],
                            "name_value"  => [
                                "type" => "string",
                                "title" => "Name value"
                            ],
                            "content_key"   => [
                                "type" => "string",
                                "title" => "Content key"
                            ],
                            "content_value" => [
                                "type" => "string",
                                "title" => "Content value"
                            ]
                        ]
                    ]
                ]
            ]
        ];


        return $this->data;
    }
}