<?php
return [
    'class'  => '\frontend\components\sitemap\Sitemapchild',
    'models' => [
        // your models
        //'app\modules\news\models\News',
        // or configuration for creating a behavior
        //Article
        [
            'class'     => 'common\models\sitemaps\Article',
//            'behaviors' => [
//                'sitemap'     => [
//                    'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
//                    'scope' => function ($model) {
//                        // @var \yii\db\ActiveQuery $model
//                        $model->select(['slug', 'updated_at']);
//                        $model->andWhere(['status' => 1]);
//                        $model->andWhere(['locale' => 'uk-UA']);
//                    },
//                        'dataClosure' => function ($model) {
//                        // @var self $model
//                        return
//                            [
//                                'loc'        => \yii\helpers\Url::to('uk/article/' . $model->slug, true),
//                                'lastmod'    => $model->updated_at,
//                                'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
//                                'priority'   => 0.8
//                        ];
//                    }
//                    ]
//                ]
            ],
            [
                'class'     => 'common\models\Article',
                'behaviors' => [
                    'sitemap'     => [
                        'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
                        'scope' => function ($model) {
                            // @var \yii\db\ActiveQuery $model
                            $model->select(['slug', 'updated_at']);
                            $model->andWhere(['status' => 1]);
//                            $model->andWhere(['locale' => 'ru-RU']);
                        },
                            'dataClosure' => function ($model) {
                            // @var self $model
                            return
                                [
                                    'loc'        => \yii\helpers\Url::to('ru/article/' . $model->slug, true),
                                    'lastmod'    => $model->updated_at,
                                    'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                                    'priority'   => 0.8
                            ];
                        }
                        ]
                    ]
                ],
//                [
//                    'class'     => 'common\models\Article',
//                    'behaviors' => [
//                        'sitemap'     => [
//                            'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
//                            'scope' => function ($model) {
//                                // @var \yii\db\ActiveQuery $model
//                                $model->select(['slug', 'updated_at']);
//                                $model->andWhere(['status' => 1]);
//                                $model->andWhere(['locale' => 'en-US']);
//                            },
//                                'dataClosure' => function ($model) {
//                                // @var self $model
//                                return
//                                    [
//                                        'loc'        => \yii\helpers\Url::to('en/article/' . $model->slug, true),
//                                        'lastmod'    => $model->updated_at,
//                                        'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
//                                        'priority'   => 0.8
//                                ];
//                            }
//                            ]
//                        ]
//                    ],
                    //Promo
                    [
                        'class'     => 'common\models\Promo',
                        'behaviors' => [
                            'sitemap'     => [
                                'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
                                'scope' => function ($model) {
                                    // @var \yii\db\ActiveQuery $model
                                    $model->select(['slug', 'updated_at']);
                                    $model->andWhere(['status' => 1]);
                                    $model->andWhere(['locale' => 'uk-UA']);
                                },
                                    'dataClosure' => function ($model) {
                                    // @var self $model
                                    return
                                        [
                                            'loc'        => \yii\helpers\Url::to('uk/promo/' . $model->slug, true),
                                            'lastmod'    => $model->updated_at,
                                            'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                                            'priority'   => 0.8
                                    ];
                                }
                                ]
                            ]
                        ],
                        [
                            'class'     => 'common\models\Promo',
                            'behaviors' => [
                                'sitemap'     => [
                                    'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
                                    'scope' => function ($model) {
                                        // @var \yii\db\ActiveQuery $model
                                        $model->select(['slug', 'updated_at']);
                                        $model->andWhere(['status' => 1]);
                                        $model->andWhere(['locale' => 'ru-RU']);
                                    },
                                        'dataClosure' => function ($model) {
                                        // @var self $model
                                        return
                                            [
                                                'loc'        => \yii\helpers\Url::to('ru/promo/' . $model->slug, true),
                                                'lastmod'    => $model->updated_at,
                                                'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                                                'priority'   => 0.8
                                        ];
                                    }
                                    ]
                                ]
                            ],
//                            [
//                                'class'     => 'common\models\Promo',
//                                'behaviors' => [
//                                    'sitemap'     => [
//                                        'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
//                                        'scope' => function ($model) {
//                                            // @var \yii\db\ActiveQuery $model
//                                            $model->select(['slug', 'updated_at']);
//                                            $model->andWhere(['status' => 1]);
//                                            $model->andWhere(['locale' => 'en-US']);
//                                        },
//                                            'dataClosure' => function ($model) {
//                                            // @var self $model
//                                            return
//                                                [
//                                                    'loc'        => \yii\helpers\Url::to('en/promo/' . $model->slug, true),
//                                                    'lastmod'    => $model->updated_at,
//                                                    'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
//                                                    'priority'   => 0.8
//                                            ];
//                                        }
//                                        ]
//                                    ]
//                                ],
                                //Page
                                [
                                    'class'     => 'common\models\Page',
                                    'behaviors' => [
                                        'sitemap'     => [
                                            'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
                                            'scope' => function ($model) {
                                                // @var \yii\db\ActiveQuery $model
                                                $model->select(['slug', 'updated_at']);
                                                $model->andWhere(['status' => 1]);
                                                $model->andWhere(['locale' => 'uk-UA']);
                                            },
                                                'dataClosure' => function ($model) {
                                                // @var self $model
                                                return [
                                                    'loc'        => \yii\helpers\Url::to('uk/' . $model->slug, true),
                                                    'lastmod'    => $model->updated_at,
                                                    'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                                                    'priority'   => 0.8
                                                ];
                                            }
                                            ],
                                        ],
                                    ],
                                    [
                                        'class'     => 'common\models\Page',
                                        'behaviors' => [
                                            'sitemap'     => [
                                                'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
                                                'scope' => function ($model) {
                                                    // @var \yii\db\ActiveQuery $model
                                                    $model->select(['slug', 'updated_at']);
                                                    $model->andWhere(['status' => 1]);
                                                    $model->andWhere(['locale' => 'ru-RU']);
                                                },
                                                    'dataClosure' => function ($model) {
                                                    // @var self $model
                                                    return [
                                                        'loc'        => \yii\helpers\Url::to('ru/' . $model->slug, true),
                                                        'lastmod'    => $model->updated_at,
                                                        'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                                                        'priority'   => 0.8
                                                    ];
                                                }
                                                ],
                                            ],
                                        ],
//                                        [
//                                            'class'     => 'common\models\Page',
//                                            'behaviors' => [
//                                                'sitemap'     => [
//                                                    'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
//                                                    'scope' => function ($model) {
//                                                        // @var \yii\db\ActiveQuery $model
//                                                        $model->select(['slug', 'updated_at']);
//                                                        $model->andWhere(['status' => 1]);
//                                                        $model->andWhere(['locale' => 'en-US']);
//                                                    },
//                                                        'dataClosure' => function ($model) {
//                                                        // @var self $model
//                                                        return [
//                                                            'loc'        => \yii\helpers\Url::to('en/' . $model->slug, true),
//                                                            'lastmod'    => $model->updated_at,
//                                                            'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
//                                                            'priority'   => 0.8
//                                                        ];
//                                                    }
//                                                    ],
//                                                ],
//                                            ],
                                            //Info
                                            [
                                                'class'     => 'common\models\Info',
                                                'behaviors' => [
                                                    'sitemap'     => [
                                                        'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
                                                        'scope' => function ($model) {
                                                            // @var \yii\db\ActiveQuery $model
                                                            $model->select(['slug', 'updated_at']);
                                                            $model->andWhere(['status' => 1]);
                                                            $model->andWhere(['locale' => 'uk-UA']);
                                                        },
                                                            'dataClosure' => function ($model) {
                                                            // @var self $model
                                                            return [
                                                                'loc'        => \yii\helpers\Url::to('uk/models/' . $model->slug, true),
                                                                'lastmod'    => $model->updated_at,
                                                                'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                                                                'priority'   => 0.8
                                                            ];
                                                        }
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'class'     => 'common\models\Info',
                                                    'behaviors' => [
                                                        'sitemap'     => [
                                                            'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
                                                            'scope' => function ($model) {
                                                                // @var \yii\db\ActiveQuery $model
                                                                $model->select(['slug', 'updated_at']);
                                                                $model->andWhere(['status' => 1]);
                                                                $model->andWhere(['locale' => 'ru-RU']);
                                                            },
                                                                'dataClosure' => function ($model) {
                                                                // @var self $model
                                                                return [
                                                                    'loc'        => \yii\helpers\Url::to('ru/models/' . $model->slug, true),
                                                                    'lastmod'    => $model->updated_at,
                                                                    'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                                                                    'priority'   => 0.8
                                                                ];
                                                            }
                                                            ],
                                                        ],
                                                    ],
//                                                    [
//                                                        'class'     => 'common\models\Info',
//                                                        'behaviors' => [
//                                                            'sitemap'     => [
//                                                                'class' => himiklab\sitemap\behaviors\SitemapBehavior::className(),
//                                                                'scope' => function ($model) {
//                                                                    // @var \yii\db\ActiveQuery $model
//                                                                    $model->select(['slug', 'updated_at']);
//                                                                    $model->andWhere(['status' => 1]);
//                                                                    $model->andWhere(['locale' => 'en-US']);
//                                                                },
//                                                                    'dataClosure' => function ($model) {
//                                                                    // @var self $model
//                                                                    return [
//                                                                        'loc'        => \yii\helpers\Url::to('en/models/' . $model->slug, true),
//                                                                        'lastmod'    => $model->updated_at,
//                                                                        'changefreq' => himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
//                                                                        'priority'   => 0.8
//                                                                    ];
//                                                                }
//                                                                ],
//                                                            ],
//                                                        ],
                                                    ],
                                                    'urls'        => [
                                                    // your additional urls
                                                    /* [
                                                      'loc'        => '/news/index',
                                                      'changefreq' => \himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                                                      'priority'   => 0.8,
                                                      'news'       => [
                                                      'publication'      => [
                                                      'name'     => 'Example Blog',
                                                      'language' => 'en',
                                                      ],
                                                      'access'           => 'Subscription',
                                                      'genres'           => 'Blog, UserGenerated',
                                                      'publication_date' => 'YYYY-MM-DDThh:mm:ssTZD',
                                                      'title'            => 'Example Title',
                                                      'keywords'         => 'example, keywords, comma-separated',
                                                      'stock_tickers'    => 'NASDAQ:A, NASDAQ:B',
                                                      ],
                                                      'images'     => [
                                                      [
                                                      'loc'          => 'http://example.com/image.jpg',
                                                      'caption'      => 'This is an example of a caption of an image',
                                                      'geo_location' => 'City, State',
                                                      'title'        => 'Example image',
                                                      'license'      => 'http://example.com/license',
                                                      ],
                                                      ],
                                                      ], */
                                                    ],
                                                    'enableGzip'  => false, // default is false
                                                    'cacheExpire' => 1, // 1 second. Default is 24 hours
                                                ];
