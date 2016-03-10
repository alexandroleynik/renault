<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'baseUrl' => (YII_ENV_PROD)? '/' : '',
    'rules'=> [
        ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
        ['pattern' => 'robots.txt', 'route' => 'site/robots'],
        ['pattern' => 'send-email', 'route' => 'site/sendemail'],
        ['pattern' => 'send-curl', 'route' => 'site/ajax_curl'], // добавил путь к екшену
        //['pattern' => 'not-found', 'route' => 'site/not-found'],
        ['pattern' => '/ru/not-found', 'route' => 'site/not-found'],
        ['pattern' => '/uk/not-found', 'route' => 'site/not-found'],
        ['pattern' => '<all:[\w\-\/\d\_]+>', 'route'=>  'site/index']
    ]
];
