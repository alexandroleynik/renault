<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WidgetText */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="text-block-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php  if ('frontend.web.robots.txt' != $model->key) { ?>

    <?php echo $form->field($model, 'key')->textInput(['maxlength' => 1024]) ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

    <?php }; ?>
    
    <?php
    echo $form->field($model, 'body')->textarea();

    /*if ('frontend.web.robots.txt' == $model->key or 'frontend.code.head.end' == $model->key or 'frontend.code.body.end' == $model->key) {
        echo $form->field($model, 'body')->textarea();
    } else {
        echo $form->field($model, 'body')->widget(\yii\imperavi\Widget::className(), [
            // More options, see http://imperavi.com/redactor/docs/
            'plugins' => ['fullscreen', 'fontcolor', 'video'],
            'options' => [
                //'allowedTags' => ['span'],
                'minHeight'       => 400,
                'maxHeight'       => 400,
                'buttonSource'    => true,
                'convertDivs'     => false,
                'replaceDivs'     => false,
                'removeEmptyTags' => false,
                'imageUpload'     => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
            ]
        ]);
    }*/
    ?>

    <?php echo $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
    <?php
    echo Html::submitButton(
        $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord
                ? 'btn btn-success' : 'btn btn-primary']
    )
    ?>
    </div>

        <?php ActiveForm::end(); ?>

</div>
