<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Domain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="domain-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'logo')->widget(\trntv\filekit\widget\Upload::classname(), [
        'url'=>['logo-upload']
    ]) ?>

    <?php echo $form->field($model, 'm_logo')->widget(\trntv\filekit\widget\Upload::classname(), [
        'url'=>['m_logo-upload']
    ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'locale')->dropDownList([
        'uk' => 'Укаїнська',
        'ru' => 'Русский'
    ]); ?>

    <?= $form->field($model, 'av_locale')->dropDownList([
        '0' => 'Мультиязычность',
        '1' => 'Только язык по умолчанию'
    ]); ?>
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
