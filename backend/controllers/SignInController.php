<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/2/14
 * Time: 11:20 AM
 */

namespace backend\controllers;

use backend\models\LoginForm;
use backend\models\AccountForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use yii\web\Controller;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use common\base\MultiModel;

class SignInController extends Controller
{
    public $defaultAction = 'login';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    public function actions()
    {
        return [
            'avatar-upload' => [
                'class'        => UploadAction::className(),
                'deleteRoute'  => 'avatar-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img  = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::className()
            ],

            /*domains logo's*/

            'logo-upload' => [
                'class'        => UploadAction::className(),
                'deleteRoute'  => 'logo-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img  = ImageManagerStatic::make($file->read())->fit(284, 90);
                    $file->put($img->encode());
                }
            ],
            'logo-delete' => [
                'class' => DeleteAction::className()
            ],

            'm_logo-upload' => [
                'class'        => UploadAction::className(),
                'deleteRoute'  => 'm_logo-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img  = ImageManagerStatic::make($file->read())->fit(110, 70);
                    $file->put($img->encode());
                }
            ],
            'm_logo-delete' => [
                'class' => DeleteAction::className()
            ]
        ];
    }

    public function actionLogin()
    {
        $this->layout = 'base';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $_SESSION['domain_id'] = Yii::$app->user->identity->domain_id;

            return $this->goBack();
        } else {
            return $this->render('login', [
                    'model' => $model
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionProfile()
    {

        $profile    = Yii::$app->user->identity->userProfile;
        $domain     = Yii::$app->user->identity->domain;

        if ($domain == null) {
            $model = new MultiModel([
                'models' => [
                    'profile'   => $profile,
                ]
            ]); 
        } else {
            $model = new MultiModel([
                'models' => [
                    'profile'   => $profile,
                    'domain'    => $domain
                ]
            ]);
        }

        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body'    => Yii::t('backend', 'Your account has been successfully saved', [], $model->getmodel('profile')->locale)
            ]);
            return $this->refresh();
        }
        return $this->render('profile', ['model'=>$model]);
    }

    public function actionAccount()
    {
        $user            = Yii::$app->user->identity;
        $model           = new AccountForm();
        $model->username = $user->username;
        if ($model->load($_POST) && $model->validate()) {
            $user->username = $model->username;
            $user->setPassword($model->password);
            $user->save();
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body'    => Yii::t('backend', 'Your profile has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('account', ['model' => $model]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'base';

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', [
                'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
         $this->layout = 'base';

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}