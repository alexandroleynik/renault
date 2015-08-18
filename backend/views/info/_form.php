<?php
$mId = strtolower($model::getClassNameNoNamespace());
?>


<?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

<?php echo $form->field($model, 'slug')->textInput(['maxlength' => 2048]) ?>

<?php
if (!empty(Yii::$app->request->queryParams['mid'])) {
    $mid = intval(Yii::$app->request->queryParams['mid']);
    echo $form->field($model, 'model_id')->hiddenInput(['value'=>$mid])->label(false);
}
?>

<?php
echo $form->field($model, 'head')->textarea([ 'style' => 'display:none;'])->label(false);

/* echo common\widgets\jsoneditorcss\JsonEditorCss::widget([
  'fieldId' => $mId . '-head',
  'options' => [
  'schema' => json_decode(file_get_contents(Yii::getAlias('@common/widgets/jsoneditorcss/assets/schema/backend.info.head.json')), true)
  ]
  ]); */
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
<?php
echo common\widgets\jsoneditor\JsonEditor::widget([
    'fieldId'   => $mId . '-head',
    //'schemaUrl' => Yii::getAlias('@web/js/json-editor/schema/info.body.json')
    'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=info-head')
]);
?>
    </div>
</div>


<?php
echo $form->field($model, 'body')->textarea([ 'style' => 'display:none;'])->label(false);
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
<?php
echo common\widgets\jsoneditor\JsonEditor::widget([
    'fieldId'   => $mId . '-body',
    //'schemaUrl' => Yii::getAlias('@web/js/json-editor/schema/info.body.json')
    'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=info-body')
]);
?>
    </div>
</div>

<?php
/* echo $form->field($model, 'domain')->dropDownList($domains, ['prompt' => '', 'multiple' => true]);

  $js = '$("#' . $mId . '-domain").select2();';
  $this->registerJs($js); */
?>

<?php
echo $form->field($model, 'published_at')->widget(
    'trntv\yii\datetimepicker\DatetimepickerWidget', [
    'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ'
    ]
)
?>

<?php echo $form->field($model, 'weight')->textInput(['maxlength' => 512]) ?>

<?php echo $form->field($model, 'status')->checkbox() ?>

