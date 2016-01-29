<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fullscreen-background">
  <img src="/img/00080954.jpg" alt="background" />
</div>
<div class="site-reset-password">
  <div class="login-box">
    <div class="login-box-body">
      <h1 class="login-box-body-heading"><?= Html::encode($this->title) ?></h1>

      <p><?=Yii::t('backend', 'Please choose your new password:'); ?></p>

      <div class="row">
          <div class="col-lg-5">
              <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                  <?= $form->field($model, 'password')->passwordInput(['autofocus' => false]) ?>

                  <div class="form-group">
                      <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-flat btn-block login-button']) ?>
                  </div>

              <?php ActiveForm::end(); ?>
          </div>
      </div>
    </div>
  </div>
</div>
