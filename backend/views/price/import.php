<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 25.02.2016
 * Time: 12:44
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([ 'options' => [ 'enctype' => "multipart/form-data", ] ]); ?>

<?= common\components\excell\ImportFileWidget::widget([
    'model' => $model, 'form' => $form, 'label' => 'File'
])?>
<?= Html::submitButton('Import') ?>
<?= common\components\excell\ImportLogWidget::widget([ 'model' => $model, ])?>

<? ActiveForm::end(); ?>