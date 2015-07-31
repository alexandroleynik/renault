<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [
        ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],        
        //['pattern' => 'site/set-locale', 'route'=>  'site/set-locale'],
        
        ['pattern' => '<all:[\w\-\/\d\_]+>', 'route'=>  'site/index']

        /*['pattern'=>'<locale:[\w\-]+>/<slug:[\w\-]+>', 'route'=> 'site/index'],
        ['pattern'=>'<locale:[\w\-]+>/<controller:[\w\-]+>/<action:[\w\-]+>/<slug:[\w\-]+>', 'route'=>  'site/index'],
        ['pattern'=>'/en', 'route'=>  'site/index'],
        ['pattern'=>'/ru', 'route'=>  'site/index'],
        ['pattern'=>'/uk', 'route'=>  'site/index']*/

    ]
];
