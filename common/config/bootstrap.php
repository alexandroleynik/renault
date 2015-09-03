<?php
// Path aliases
Yii::setAlias('@base', realpath(__DIR__ . '/../../'));
Yii::setAlias('@common', realpath(__DIR__ . '/../../common'));
Yii::setAlias('@frontend', realpath(__DIR__ . '/../../frontend'));
Yii::setAlias('@backend', realpath(__DIR__ . '/../../backend'));
Yii::setAlias('@console', realpath(__DIR__ . '/../../console'));
Yii::setAlias('@storage', realpath(__DIR__ . '/../../storage'));
Yii::setAlias('@api', realpath(__DIR__ . '/../../api'));
Yii::setAlias('@tests', realpath(__DIR__ . '/../../tests'));

// Url Aliases
Yii::setAlias('@frontendUrl', getenv('FRONTEND_URL'));
Yii::setAlias('@frontendUrls', getenv('FRONTEND_URLS'));
Yii::setAlias('@domainId', '0');
Yii::setAlias('@backendUrl', getenv('BACKEND_URL'));
Yii::setAlias('@storageUrl', getenv('STORAGE_URL'));
Yii::setAlias('@apiUrl', getenv('API_URL'));

Yii::setAlias('@isAjaxRequest', (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])
    == 'xmlhttprequest' ? true : false));

require_once (__DIR__ . '/_domain.php');
