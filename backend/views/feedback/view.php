<?php
$user = \api\models\User::findOne($model->domain_id);
$user = $user ? $user->username : '';
echo 'Сообщение № ' . $model->id;
?>
<br/>
<h4>Сообщение от <?= $user; ?> ;</h4>
<br/>
<h2><b><?= $model->subject; ?></b></h2>
<p><?= $model->text; ?></p>
    <br/>
<?php //\yii\helpers\VarDumper::dump($model , 11, true);