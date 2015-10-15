<?php

/*use common\models\Model;

Model::getLeftMenuListItems2();

die();*/
?>

<?php
$mId = strtolower($model::getClassNameNoNamespace());
?>

<?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>
<?php echo $form->field($model, 'price')->textInput(['maxlength' => 512]) ?>

<?php
echo $form->field($model, 'categoriesList')->dropDownList(\yii\helpers\ArrayHelper::map(
        $categories, 'id', 'title'
    ), ['prompt' => '', 'multiple' => true, 'style' => 'border: none; margin:0px; padding:0px;']);

$js = '$("#' . $mId . '-categorieslist").select2();';
$this->registerJs($js);
?>

<?php
echo $form->field($model, 'thumbnail')->widget(
    \trntv\filekit\widget\Upload::className(), [
    'url'         => ['/file-storage/upload'],
    'maxFileSize' => 5000000, // 5 MiB
]);
?>

<?php echo $form->field($model, 'status')->checkbox() ?>

