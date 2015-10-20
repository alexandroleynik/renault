<?php
$config = [
    'components'    => [
        'assetManager' => [
            'class'           => 'yii\web\AssetManager',
            'linkAssets'      => true,
            'appendTimestamp' => YII_ENV_DEV
        ]
    ],
    'as locale'     => [
        'class'                   => 'common\behaviors\LocaleBehavior',
        'enablePreferredLanguage' => true
    ],
    'as corsFilter' => [
        'class' => \yii\filters\Cors::className(),
        'cors'  => [
            // allow access to
            'Origin' => array_merge(
                [
                'https://fr.proxfree.com',
                'http://fr.proxfree.com',
                Yii::getAlias('@frontendUrl'),
                Yii::getAlias('@backendUrl')
                ], explode(',', Yii::getAlias('@frontendUrls'))
            ),
        ],
    ],
];

if (YII_DEBUG) {
    /* $config['bootstrap'][]      = 'debug';
      $config['modules']['debug'] = [
      'class'      => 'yii\debug\Module',
      'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1'],
      ]; */
}

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1'],
    ];
}


return $config;
