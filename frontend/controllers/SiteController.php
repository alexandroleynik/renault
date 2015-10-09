<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ContactForm;
use yii\web\Controller;
use common\widgets\DbText;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            /* 'set-locale' => [
              'class'   => 'common\actions\SetLocaleAction',
              'locales' => array_keys(Yii::$app->params['availableLocales'])
              ] */
        ];
    }

    public function actionIndex()
    {
        $this->layout = '@frontend/views/layouts/main.php';
        return $this->render('index');
    }

    public function actionMessage($message)
    {
        return $this->render('message', [
                'message' => $message,
        ]);
    }

    public function actionRobots()
    {
        //header("Content-type: text/plain");

        Yii::$app->response->data   = '<pre style="word-wrap: break-word; white-space: pre-wrap;">' . DbText::widget(['key' => 'frontend.web.robots.txt']) . '</pre>';
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

        return Yii::$app->response;
    }

    public function beforeAction($action)
    {
        if ($action->id == 'error') $this->layout = 'static.php';

        return parent::beforeAction($action);
    }
}