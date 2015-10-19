<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Domain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="domain-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'dealer_id')->dropDownList(
        $dealerItems, [
        'prompt' => ''
    ])
    ?>

    <?php
    /* echo $form->field($model, 'locales')->dropDownList(['1'=>'one'], ['prompt' => '', 'multiple' => true]);

      $js = '$("#domain-locales").select2();';
      $this->registerJs($js); */
    ?>

<?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord
                    ? 'btn btn-success' : 'btn btn-primary'])
        ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
