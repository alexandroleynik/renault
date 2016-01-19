<?php
use yii\helpers\Html;
?>

<div class="password-reset">

    <p>Здравствуйте, сообщение от <?= Html::encode($firstname) ?>,</p>

    <p><?= Html::encode($message) ?></p>

    <p><?php echo date('l jS \of F Y h:i:s A', $date);?></p>
</div>