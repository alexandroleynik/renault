<?php
$mId = strtolower($model::getClassNameNoNamespace());

?>


<?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

<?php
echo $form->field($model, 'slug')
    ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
    ->textInput(['maxlength' => 1024])
?>

<?php echo $form->field($model, 'description')->textInput(['maxlength' => 512]) ?>

<?php
echo $form->field($model, 'categoriesList')->dropDownList(\yii\helpers\ArrayHelper::map(
        $categories, 'id', 'title'
    ), ['prompt' => '', 'multiple' => true, 'style' => 'display:none;'])->label(false);

$js = '$("#' . $mId . '-categorieslist").select2();';
$this->registerJs($js);
?>


<?php
echo $form->field($model, 'head')->textarea([ 'style' => 'display:none;'])->label(false);

?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
        <?php
        echo common\widgets\jsoneditor\JsonEditor::widget([
            'fieldId'   => $mId . '-head',
            //'schemaUrl' => Yii::getAlias('@web/js/json-editor/schema/article.body.json')
            'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=article-head&language=' . Yii::$app->language . '&domain_id=' . \Yii::$app->user->identity->domain_id)
        ]);
        ?>
    </div>
</div>

<?php
/* echo common\widgets\jsoneditorcss\Upload::widget([
  'editorKey' => $mId . '-head',
  'fieldName' => 'root[common][image][content]'
  ]); */
?>


<?php
echo $form->field($model, 'body')->textarea([ 'style' => 'display:none;'])->label(false);
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
        <?php
        echo common\widgets\jsoneditor\JsonEditor::widget([
            'fieldId'   => $mId . '-body',            
            'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=article-body&language=' . Yii::$app->language . '&domain_id=' . \Yii::$app->user->identity->domain_id)
        ]);
        ?>
    </div>
</div>

<?php
echo $form->field($model, 'thumbnail')->widget(
    \trntv\filekit\widget\Upload::className(), [
    'url'         => ['/file-storage/upload'],
    'maxFileSize' => 5000000, // 5 MiB
]);
?>

<?php
echo $form->field($model, 'attachments')->widget(
    \trntv\filekit\widget\Upload::className(), [
    'url'              => ['/file-storage/upload'],
    'sortable'         => true,
    'maxFileSize'      => 10000000, // 10 MiB
    'maxNumberOfFiles' => 10
]);
?>

<?php
/*echo $form->field($model, 'domain')->dropDownList($domains, ['prompt' => '', 'multiple' => true]);

$js = '$("#' . $mId . '-domain").select2();';
$this->registerJs($js);*/
?>

<?php
echo $form->field($model, 'published_at')->widget(
    'trntv\yii\datetimepicker\DatetimepickerWidget', [
    'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ'
    ]
)
?>

<?php echo $form->field($model, 'status')->checkbox() ?>

<?php
//syncTranslit for fielt title and slug
$js = 'var obj = "article";';
$js .= '$(document).ready(function(){ $("#" + obj + "ukua-title").syncTranslit({destination: obj + "ukua-slug", urlSeparator: "-"}); });';
$js .= '$(document).ready(function(){ $("#" + obj + "ruru-title").syncTranslit({destination: obj + "ruru-slug", urlSeparator: "-"}); });';
$js .= '$(document).ready(function(){ $("#" + obj + "enus-title").syncTranslit({destination: obj + "enus-slug", urlSeparator: "-"}); });';

$this->registerJs($js, yii\web\View::POS_READY );
?>
