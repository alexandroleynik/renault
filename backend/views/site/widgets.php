<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = Yii::t('backend', 'Widgets list');
?>

<div class="panel panel-default">
    <!-- Table -->
    <table class="table">
        <thead>
            <tr>
                <td><h3><?php echo Yii::t('backend', 'id'); ?></h3></td>
                <td><h3><?php echo Yii::t('backend', 'title'); ?></h3></td>
            </tr>

        </thead>
        <tbody>
            <?php
            foreach ($models as $key => $value) {
                echo '<tr><td>' . $value['id'] . '</td><td>' . $value['title'] . '</td></tr>';
            }
            ?>
        </tbody>

    </table>
</div>