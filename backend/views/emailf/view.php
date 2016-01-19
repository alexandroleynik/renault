<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

echo 'Сообщение № ' . $model->id;
?>
<br/>
<h4>Сообщение от <?= $user; ?> ;</h4>
<br/>
<h2><b><?= $model->subject; ?></b></h2>
<p><?= $model->text; ?></p>
<br/>
<?php $form = ActiveForm::begin(['action' => \yii\helpers\Url::toRoute(['update', 'id' => $model->id])]); ?>

<?php if (\Yii::$app->user->can('administrator')) : ?>
    <?php echo !$model->isNewRecord ?  $form->field($model, 'status')->checkbox():  ''; ?>
<?php endif; ?>
<div class="form-group">
    <?php
    echo Html::submitButton(
        Yii::t('backend', 'Refresh'), ['class' => $model->isNewRecord
        ? 'btn btn-success' : 'btn btn-primary'])
    ?>
    <!--button type="button" class="btn btn-primary" id="previewButton">Preview</button-->
</div>

<?php ActiveForm::end(); ?>
