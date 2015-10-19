<?php
$config = [
    'homeUrl'             => Yii::getAlias('@frontendUrl') . '/uk/home',
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute'        => 'site/index',
    'layout'              => false, //'@frontend/views/layouts/ajax.php',
    'modules'             => require(__DIR__.'/_modules.php'),
    'components'          => [
        'authClientCollection' => [
            'class'   => 'yii\authclient\Collection',
            'clients' => [
                'github' => [
                    'class'        => 'yii\authclient\clients\GitHub',
                    'clientId'     => getenv('GITHUB_CLIENT_ID'),
                    'clientSecret' => getenv('GITHUB_CLIENT_SECRET')
                ]
            ]
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'errorHandler'         => [
            'errorAction' => 'site/error'
        ],
        'request'              => [
            'baseUrl' => (YII_ENV_PROD)? '/' : '',
            'cookieValidationKey' => getenv('FRONTEND_COOKIE_VALIDATION_KEY')
        ],
        'user'                 => [
            'class'           => 'yii\web\User',
            'identityClass'   => 'common\models\User',
            'loginUrl'        => ['/user/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin'   => 'common\behaviors\LoginTimestampBehavior'
        ],
        'assetManager' => [
            'bundles' => false,
        ]
    ]
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class'      => 'yii\gii\Module',
        'generators' => [
            'crud' => [
                'class'           => 'yii\gii\generators\crud\Generator',
                'messageCategory' => 'frontend'
            ]
        ]
    ];
}

if (YII_ENV_PROD) {
    // Maintenance mode
    $config['bootstrap']                 = ['maintenance'];
    $config['components']['maintenance'] = [
        'class'   => 'common\components\maintenance\Maintenance',
        'enabled' => function ($app) {
            return $app->keyStorage->get('frontend_maintenance') === 'true';
        }
    ];
}

return $config;
