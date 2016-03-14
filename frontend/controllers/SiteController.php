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
    	if (Yii::$app->request->isAjax) {
    		$massive_data = Yii::$app->request->post(); // получаем пост
    		
    		if ($massive_data['code_select'] == 'key') {
    			$phone = '+38('.$massive_data['code'].')'.$massive_data['punkt7'];
    		} else {
    			$phone = '+38('.$massive_data['code_select'].')'.$massive_data['punkt7'];
    		}

            switch ($massive_data['form_id']) { // формирование массива в зависимости от идентификатора формы
                case 3: // тестдрайф
                    $data=array( // заполненый массив с тестовыми данными
                        'Fields' => array(
                            '0' => array (
                                'key' => 'RenaultDealerId',
                                'value' => $massive_data['selected_id'],
                            ),
                            '1' => array (
                                'key' => 'CategoryId',
                                'value' => 3,
                            ),
                            '2' => array (
                                'key' => 'DealerId',
                                'value' => $massive_data['salon_id'], // нужно достать єто значение
                            ),
                            '3' => array (
                                'key' => 'RenaultDealerDomain',
                                'value' => $massive_data['RenaultDealerDomain'],
                            ),
                            '4' => array (
                                'key' => 'LastName',
                                'value' => $massive_data['punkt'][$massive_data['field-lastname']],
                            ),
                            '5' => array (
                                'key' => 'FirstName',
                                'value' => $massive_data['punkt'][$massive_data['field-firstname']],
                            ),
                            '6' => array (
                                'key' => 'Patronymic',
                                'value' => $massive_data['punkt'][$massive_data['field-secondname']],
                            ),
                            '7' => array (
                                'key' => 'BirthDate',
                                'value' => '24.04.1998', // и єто значение
                            ),
                            '8' => array (
                                'key' => 'VehicleModel',
                                'value' => $massive_data['punkt'][5],
                            ),
                            '9' => array (
                                'key' => 'eMail',
                                'value' => $massive_data['punkt'][$massive_data['field-email']],
                            ),
                            '10' => array (
                                'key' => 'DaytimePhoneNumber',
                                'value' => $phone,
                            ),
                            '11' => array (
                                'key' => 'TestDriveSuggestions',
                                'value' => $massive_data['punkt'][8],
                            ),
                            '12' => array (
                                'key' => 'TestDriveSuggestions',
                                'value' => $massive_data['punkt'][9],
                            ),
                            '13' => array (
                                'key' => 'UsingPersonalInfo',
                                'value' => $massive_data['check_data'],
                            ),
                            '14' => array (
                                'key' => 'CampaignUniqueId',
                                'value' => $massive_data['CampaignUniqueId'],
                            ),
                            '15' => array (
                                'key' => 'Media',
                                'value' => $massive_data['Media'],
                            ),
                            '16' => array (
                                'key' => 'ContactByPhone',
                                'value' => $massive_data['phone_subscr'], // и єти значения
                            ),
                            '17' => array (
                                'key' => 'ContactByMail',
                                'value' => $massive_data['email_subscr'],// и єти значения
                            )
                        ),
                        'Token' => 'String content',
                    );
                    break;
                case 5: // сервис
                    $data=array( // заполненый массив с тестовыми данными
                        'Fields' => array(
                            '0' => array (
                                'key' => 'RenaultDealerId',
                                'value' => $_POST['selected_id'],
                            ),
                            '1' => array (
                                'key' => 'CategoryId',
                                'value' => 5,
                            ),
                            '2' => array (
                                'key' => 'DealerId',
                                'value' => $massive_data['salon_id'],
                            ),
                            '3' => array (
                                'key' => 'RenaultDealerDomain',
                                'value' => $massive_data['RenaultDealerDomain'],
                            ),
                            '4' => array (
                                'key' => 'LastName',
                                'value' => $massive_data['punkt'][$massive_data['field-lastname']],
                            ),
                            '5' => array (
                                'key' => 'FirstName',
                                'value' => $massive_data['punkt'][$massive_data['field-firstname']],
                            ),
                            '6' => array (
                                'key' => 'Patronymic',
                                'value' => $massive_data['punkt'][$massive_data['field-secondname']],
                            ),
                            '7' => array (
                                'key' => 'VehicleModel',
                                'value' => $massive_data['punkt'][5],
                            ),
                            '8' => array (
                                'key' => 'eMail',
                                'value' => $massive_data['punkt'][$massive_data['field-email']],
                            ),
                            '9' => array (
                                'key' => 'DaytimePhoneNumber',
                                'value' => $phone,
                            ),
                            '10' => array (
                                'key' => 'VehicleVIN',
                                'value' => $massive_data['punkt'][8], // готово
                            ),
                            '11' => array (
                                'key' => 'ConnectionKind',
                                'value' => $massive_data['punkt'][10], // готово
                            ),
                            '12' => array (
                                'key' => 'Besttimetocall',
                                'value' => $massive_data['punkt'][11], // готово
                            ),
                            '13' => array (
                                'key' => 'IspolzovanijeServisa',
                                'value' => $massive_data['punkt'][9], // готово
                            ),
                            '14' => array (
                                'key' => 'Dateofwork',
                                'value' => $massive_data['punkt'][12], // готово
                            ),
                            '15' => array (
                                'key' => 'Timeofwork',
                                'value' => $massive_data['punkt'][14], // готово
                            ),
                            '16' => array (
                                'key' => 'Issue',
                                'value' => $massive_data['punkt'][13],
                            ),
                            '17' => array (
                                'key' => 'ComplaintReason',
                                'value' => $massive_data['punkt'][16],
                            ),
                            '18' => array (
                                'key' => 'UsingPersonalInfo',
                                'value' => $massive_data['check_data'],
                            ),
                            '19' => array (
                                'key' => 'CampaignUniqueId',
                                'value' => $massive_data['CampaignUniqueId'],
                            ),
                            '20' => array (
                                'key' => 'Media',
                                'value' => $massive_data['Media'],
                            ),
                        ),
                        'Token' => 'String content',
                    );
                    break;
                case 7: // финансы
                    $data=array( // заполненый массив с тестовыми данными
                        'Fields' => array(
                            '0' => array (
                                'key' => 'RenaultDealerId',
                                'value' => $massive_data['selected_id'],
                            ),
                            '1' => array (
                                'key' => 'CategoryId',
                                'value' => 7,
                            ),
                            '2' => array (
                                'key' => 'DealerId',
                                'value' => $massive_data['salon_id'],
                            ),
                            '3' => array (
                                'key' => 'RenaultDealerDomain',
                                'value' => $massive_data['RenaultDealerDomain'],
                            ),
                            '4' => array (
                                'key' => 'LastName',
                                'value' => $massive_data['punkt'][$massive_data['field-lastname']],
                            ),
                            '5' => array (
                                'key' => 'FirstName',
                                'value' => $massive_data['punkt'][$massive_data['field-firstname']],
                            ),
                            '6' => array (
                                'key' => 'Patronymic',
                                'value' => $massive_data['punkt'][$massive_data['field-secondname']],
                            ),
                            '7' => array (
                                'key' => 'VehicleModel',
                                'value' => $massive_data['punkt'][5],
                            ),
                            '8' => array (
                                'key' => 'eMail',
                                'value' => $massive_data['punkt'][$massive_data['field-email']],
                            ),
                            '9' => array (
                                'key' => 'Question',
                                'value' => $massive_data['comment'],
                            ),
                            '10' => array (
                                'key' => 'YourCar',
                                'value' => $massive_data['haveacar'],
                            ),
                            '11' => array (
                                'key' => 'FinancingMode',
                                'value' => $massive_data['funding'],
                            ),
                            '12' => array (
                                'key' => 'UsingPersonalInfo',
                                'value' => $massive_data['policy'],
                            ),
                            '13' => array (
                                'key' => 'DaytimePhoneNumber',
                                'value' => $phone,
                            ),
                            '14' => array (
                                'key' => 'CampaignUniqueId',
                                'value' => $massive_data['CampaignUniqueId'],
                            ),
                            '15' => array (
                                'key' => 'Media',
                                'value' => $massive_data['Media'],
                            ),
                        ),
                        'Token' => 'String content',
                    );
                    break;
                case 2: // связь с дилером
                    $data=array( // заполненый массив с тестовыми данными
                        'Fields' => array(
                            '0' => array (
                                'key' => 'RenaultDealerId',
                                'value' => $massive_data['selected_id'],
                            ),
                            '1' => array (
                                'key' => 'CategoryId',
                                'value' => 2,
                            ),
                            '2' => array (
                                'key' => 'DealerId',
                                'value' =>  $massive_data['salon_id'],
                            ),
                            '3' => array (
                                'key' => 'RenaultDealerDomain',
                                'value' => $massive_data['RenaultDealerDomain'],
                            ),
                            '4' => array (
                                'key' => 'LastName',
                                'value' => $massive_data['punkt'][3],
                            ),
                            '5' => array (
                                'key' => 'FirstName',
                                'value' => $massive_data['punkt'][1],
                            ),
                            '6' => array (
                                'key' => 'Patronymic',
                                'value' => $massive_data['punkt'][2],
                            ),
                            '7' => array (
                                'key' => 'eMail',
                                'value' => $massive_data['punkt'][6],
                            ),
                            '8' => array (
                                'key' => 'DaytimePhoneNumber',
                                'value' => $phone,
                            ),
                            '9' => array (
                                'key' => 'Description',
                                'value' => $massive_data['punkt'][8],
                            ),
                            '10' => array (
                                'key' => 'UsingPersonalInfo',
                                'value' => $massive_data['punkt'][10],
                            ),
                            '11' => array (
                                'key' => 'CampaignUniqueId',
                                'value' => $massive_data['CampaignUniqueId'],
                            ),
                            '12' => array (
                                'key' => 'Media',
                                'value' => $massive_data['Media'],
                            ),
                        ),
                        'Token' => 'String content',
                    );
                    break;
            }

			
			// $url = "https://lmt-ua.makolab.net/LMTService.svc/rest/SaveLeadJson"; // путь к лмт
			// $data=json_encode($data); // json формат массива
			
			// // сам курл запроса
			// $curl = curl_init($url);
			// curl_setopt($curl, CURLOPT_HEADER, false);
			// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			// curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
			// curl_setopt($curl, CURLOPT_POST, true);
			// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			// $json_response = curl_exec($curl);
			// curl_close($curl);
			
			
			
			// $xml = new \SimpleXMLElement($json_response); // примем ответа от сервера
			// $bla = $xml->ErrorCode; // получение кода ошиби ну или ответа
			
			
			var_dump($massive_data);
			exit();
			
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	        return [
	            'response' => $bla, // возвращаем обратно результат
	        ];
    			
    	}
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
