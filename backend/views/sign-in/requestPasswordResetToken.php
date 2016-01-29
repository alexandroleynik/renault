<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('backend', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fullscreen-background">
  <img src="/img/00080954.jpg" alt="background" />
</div>
<div class="site-request-password-reset">
  <div class="login-box">
    <div class="login-box-body">
      <h1 class="login-box-body-heading"><?= Html::encode($this->title) ?></h1>
      <p><?=Yii::t('backend', 'Please fill out your email. A link to reset password will be sent there.') ?></p>

      <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

          <?= $form->field($model, 'email')->textInput(['autofocus' => false]) ?>

          <div class="form-group">
              <?= Html::submitButton(Yii::t('backend', 'Send'),
                ['class' => 'btn btn-flat btn-block login-button']) ?>
          </div>

      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
