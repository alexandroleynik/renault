<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>
<?php echo $form->field($model, 'text')->textInput() ?>
<?php echo $form->field($model, 'dealers_id')->hiddenInput(['value'=> \Yii::$app->user->identity->domain_id])->label(false);
?>
<div class="form-group">
    <?php
    echo Html::submitButton(
        $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord
        ? 'btn btn-success' : 'btn btn-primary'])
    ?>
    <!--button type="button" class="btn btn-primary" id="previewButton">Preview</button-->
</div>

<?php ActiveForm::end(); ?>