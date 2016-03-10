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
    
    public function actionAjax_curl()
    {
        $data=array( // заполненый массив с тестовыми данными
	'Fields' => array(
		'0' => array (
    			'key' => 'RenaultDealerId',
    			'value' => 34,
    		),
    		'1' => array (
    			'key' => 'CategoryId',
    			'value' => 3,
    		),
    		'2' => array (
    			'key' => 'DealerId',
    			'value' => 27,
    		),
		'3' => array (
			'key' => 'RenaultDealerDomain',
			'value' => 'Источник лида: test.com.ua',
		),
		'4' => array (
			'key' => 'LastName',
			'value' => 'Тест Тест',
		),
		'5' => array (
			'key' => 'FirstName',
			'value' => 'Тест Тест',
		),
		'6' => array (
			'key' => 'Patronymic',
			'value' => 'Тест Тест',
		),
		'7' => array (
			'key' => 'BirthDate',
			'value' => '24.04.1998',
		),
		'8' => array (
			'key' => 'VehicleModel',
			'value' => 'Capture',
		),
		'9' => array (
			'key' => 'eMail',
			'value' => 'test1@test.com',
		),
		'10' => array (
			'key' => 'DaytimePhoneNumber',
			'value' => '+38(093)0000000',
		),
		'11' => array (
			'key' => 'TestDriveSuggestions',
			'value' => '11.03.2016',
		),
		'12' => array (
			'key' => 'TestDriveSuggestions',
			'value' => '12:00-13:00',
		),
		'13' => array (
			'key' => 'UsingPersonalInfo',
			'value' => 'yes',
		),
		'14' => array (
			'key' => 'CampaignUniqueId',
			'value' => '...',
		),
		'15' => array (
			'key' => 'Media',
			'value' => 'http://test.com.ua',
		),
		'16' => array (
			'key' => 'ContactByPhone',
			'value' => 'true',
		),
		'17' => array (
			'key' => 'ContactByMail',
			'value' => 'false',
		)
		),
		'Token' => 'String content',
	);
	
	/*$url = "https://lmt-ua.makolab.net/LMTService.svc/rest/SaveLeadJson"; // путь к лмт
	$data=json_encode($data); // json формат массива
	
	// сам курл запроса
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$json_response = curl_exec($curl);
	curl_close($curl);*/
	
	
	
	$xml = new \SimpleXMLElement($json_response); // примем ответа от сервера
	$bla = $xml->ErrorCode; // получение кода ошиби ну или ответа
	
	var_dump($bla);
		
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
