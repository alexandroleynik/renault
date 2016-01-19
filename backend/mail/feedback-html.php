<?php
use yii\helpers\Html;
?>

<div class="password-reset">

    <p>Здравствуйте, сообщение от <?= $name; ?>,</p>

    <p><?= $message; ?></p>

    <p><?php echo date('l jS \of F Y h:i:s A', $date);?></p>
</div>