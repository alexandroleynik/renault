<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'baseUrl' => (YII_ENV_PROD)? '/' : '',
    'rules'=> [
        ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],                        
        ['pattern' => '<all:[\w\-\/\d\_]+>', 'route'=>  'site/index']
    ]
];
