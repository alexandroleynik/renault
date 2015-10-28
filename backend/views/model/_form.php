<?php

use \yii\helpers\ArrayHelper;

$mId = strtolower($model::getClassNameNoNamespace());

$categoryList = ArrayHelper::map($categories, 'id', 'title');
foreach ($categoryList as $key => $value) {
    $categoryList[$key] = \Yii::t('backend', $value);
}
?>

<?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>
<?php echo $form->field($model, 'price')->textInput(['maxlength' => 512]) ?>

<?php
echo $form->field($model, 'categoriesList')->dropDownList(
    $categoryList, [
    'prompt'   => '',
    'multiple' => true,
    'style'    => 'border: none; margin:0px; padding:0px;'
    ]
);

$js = '$("#' . $mId . '-categorieslist").select2();';
$this->registerJs($js);
?>

<?php
echo $form->field($model, 'weight')
    ->hint(Yii::t('backend', 'Used for sorting'))
    ->textInput(['maxlength' => 1024])
?>

<?php
echo $form->field($model, 'thumbnail')->widget(
    \trntv\filekit\widget\Upload::className(), [
    'url'         => ['/file-storage/upload'],
    'maxFileSize' => 5000000, // 5 MiB
]);
?>

<?php echo $form->field($model, 'status')->checkbox() ?>

