<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['sign-in/reset-password', 'token' => $user->password_reset_token]);
?>
    Здравствуйте, <?= $user->username ?>,

    Для восстановления пароля перейдите по ссылке:

<?= $resetLink ?>