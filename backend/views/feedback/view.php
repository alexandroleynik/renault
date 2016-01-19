<?php
$user = \api\models\User::findOne($model->domain_id);
$user = $user ? $user->username : '';
echo $model->id;
?>
<br/>
Сообщение от <?= $user; ?> ;
<br/>
<h2><b><?= $model->subject; ?></b></h2>
<?= $model->text; ?>
    <br/>
<?php //\yii\helpers\VarDumper::dump($model , 11, true);