<?php
return [
    'class'           => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName'  => false,
    'rules'           => [
        // Api 16on9
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/article-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/promo', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/promo-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/model', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/model-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/info', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/info-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/client', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/client-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/member', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/member-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/project', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/project-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/user', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/widget-text', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/page', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/block', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/service', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/service-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/service-page', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/service-page-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/about', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/about-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/about-page', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/about-page-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/finance-page', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/finance-page-category', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/subscribes', 'only' => ['create', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'db/corporate', 'only' => ['create', 'options']],
        ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
    ]
];
