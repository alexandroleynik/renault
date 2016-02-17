<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ContactForm;
use yii\web\Controller;
use common\widgets\DbText;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $nick;
    public $email;
    public $message;

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
        $this->_checkBrowser();
        $searchModel  = new \common\models\User();

        $this->layout = '@frontend/views/layouts/main.php';
        //$this->layout = '@frontend/views/layouts/proxy_test.php';
        return $this->render('index',[
            'searchModel' => $searchModel
        ]);
    }

    public function actionMessage($message)
    {
        return $this->render('message', [
                'message' => $message,
        ]);
    }

    public function actionRobots()
    {
        header("Content-type: text/plain");

        Yii::$app->response->data   = DbText::widget(['key' => 'frontend.web.robots.txt', 'domain_id' => Yii::getAlias('@domainId')]);
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

        return Yii::$app->response;
    }

    public function actionSendemail()
    {
        $post = \Yii::$app->request->post();
//        \yii\helpers\VarDumper::dump($post, 11, 1);
//die();


        $firstname  = $post['first_name'];
        $secondname = $post['secondname'];
        $lastname   = $post['lastname'];
        $email      = $post['email'];
        $phone      = $post['phone'];
        $message    = $post['message'];


        $emailTo = $post['myemail'];

        Yii::$app->mailer->compose('feedback_request', [
                'firstname'  => $firstname,
                'secondname' => $secondname,
                'lastname'   => $lastname,
                'email'      => $email,
                'phone'      => $phone,
                'message'    => $message
            ])
            ->setSubject(Yii::t('frontend', '{app-name} | Feedback request from', [
                    'app-name' => Yii::$app->name
            ]))
            ->setTo($emailTo)
            ->send();

        return true;
    }

    public function beforeAction($action)
    {
        if ($action->id == 'error') $this->layout = 'static.php';

        if (Yii::$app->getErrorHandler()->exception instanceof NotFoundHttpException) {

            switch (Yii::$app->language) {
                case 'uk-UA':
                    $redirectPath = '/uk/not-found';
                    break;
                case 'ru-RU':
                    $redirectPath = '/ru/not-found';
                    break;
                default :
                    $redirectPath = '/uk/not-found';
            }
            
            $this->redirect($redirectPath);
        }

        return parent::beforeAction($action);
    }

    private function _checkBrowser()
    {
        $currentBrowser = $this->_getBrowser($_SERVER['HTTP_USER_AGENT']);
        $badBrowsers    = file(Yii::getAlias('@frontend/config/badBrowserList.txt'));

        foreach ($badBrowsers as $key => $value) {
            $badBrowser        = trim(explode('<', $value)[0]);
            $badBrowserVersion = trim(explode('<', $value)[1]);

            if ($currentBrowser['browser'] == $badBrowser) {
                if (-1 == version_compare($currentBrowser['version'], $badBrowserVersion)) {
                    //$this->redirect(Yii::getAlias('@frontendUrl/page/newbrowser.html'));
                }
            }
        }
    }

    private function _getBrowser($agent)
    {
        preg_match("/(MSIE|Opera|Firefox|Chrome|Version|Opera Mini|Netscape|Konqueror|SeaMonkey|Camino|Minefield|Iceweasel|K-Meleon|Maxthon|Trident)(?:\/| )([0-9.]+)/", $agent, $browser_info);

        if  (empty($browser_info[1])) {
            $browser_info[1] = '';
        }

        if  (empty($browser_info[2])) {
            $browser_info[2] = '';
        }

        list(, $browser, $version) = $browser_info;

        switch ($browser) {
            case 'MSIE':
                preg_match("/(Maxthon|Avant Browser|MyIE2)/i", $agent, $ie);
                if ($ie) {
                    $browser = 'unknown';
                    $version = $ie[1] . ' based on IE ' . $version;
                }

                $browser = 'IE';
                $version = $version;

                break;
            case 'Trident':
                if ('7.0' == $version) {
                    $browser = 'IE';
                    $version = '11.0';
                }

                break;
            case 'Firefox':
                preg_match("/(Flock|Navigator|Epiphany)\/([0-9.]+)/", $agent, $ff);
                if ($ff) {
                    $browser = $ff[1];
                    $version = $ff[2];
                }

                break;
            case 'Opera':
                if ($version == '9.80') {
                    $browser = 'Opera';
                    $version = substr($agent, -5);
                }

                break;
            case 'Version':
                $browser = 'Safari';
                $version = $version;

                break;

            default:
                if (preg_match("/Opera ([0-9.]+)/i", $agent, $opera)) {
                    $browser = 'Opera';
                    $version = $opera[1];
                }

                if (!$browser && strpos($agent, 'Gecko')) {
                    $browser = 'unknown';
                    $version = 'Browser based on Gecko';
                }

                if (!$browser) {
                    $browser = 'unknown';
                }

                if (!$version) {
                    $version = 'unknown';
                }

                break;
        }

        return [
            'browser' => $browser,
            'version' => $version
        ];
    }

    public function actionNotFound()
    {
        $this->layout = 'static.php';

        switch (Yii::$app->language) {
            case 'uk-UA':
                $viewName = 'not-found-ua';
                break;
            case 'ru-RU':
                $viewName = 'not-found-ru';
                break;
            default :
                $viewName = 'not-found-ua';
        }


        return $this->render($viewName);
    }
}