<?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>
<?php echo $form->field($model, 'price')->textInput(['maxlength' => 512]) ?>

<?php
echo $form->field($model, 'thumbnail')->widget(
    \trntv\filekit\widget\Upload::className(), [
    'url'         => ['/file-storage/upload'],
    'maxFileSize' => 5000000, // 5 MiB
]);
?>

<?php echo $form->field($model, 'status')->checkbox() ?>

