<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?php echo $form->field($model, 'email')->input('email') ?>


<?php echo $form->field($model, 'status')->checkbox(); ?>

<div class="form-group">
    <?php
    echo Html::submitButton(
        $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord
        ? 'btn btn-success' : 'btn btn-primary'])
    ?>

</div>

<?php ActiveForm::end(); ?>

