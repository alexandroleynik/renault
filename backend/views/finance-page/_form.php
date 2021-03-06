<?php
$mId = strtolower($model::getClassNameNoNamespace());
?>


<?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

<?php echo $form->field($model, 'slug')->textInput(['maxlength' => 2048]) ?>

<?php
if (!empty(Yii::$app->request->queryParams['mid'])) {
    $mid = intval(Yii::$app->request->queryParams['mid']);
    echo $form->field($model, 'finance_id')->hiddenInput(['value'=>$mid])->label(false);
}
?>

<?php
echo $form->field($model, 'head')->textarea([ 'style' => 'display:none;'])->label(false);
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
        <?php
        echo common\widgets\jsoneditor\JsonEditor::widget([
            'fieldId'   => $mId . '-head',
            'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=info-head&language=' . Yii::$app->language . '&domain_id=' . \Yii::$app->user->identity->domain_id)
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
    'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=info-body&language=' . Yii::$app->language . '&domain_id=' . \Yii::$app->user->identity->domain_id)
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

<?php //echo $form->field($model, 'weight')->textInput(['maxlength' => 512]) ?>

<?php echo $form->field($model, 'status')->checkbox() ?>

<?php
//syncTranslit for fielt title and slug
$js = 'var obj = "financepage";';
$js .= '$(document).ready(function(){ $("#" + obj + "ukua-title").syncTranslit({destination: obj + "ukua-slug", urlSeparator: "-"}); });';
$js .= '$(document).ready(function(){ $("#" + obj + "ruru-title").syncTranslit({destination: obj + "ruru-slug", urlSeparator: "-"}); });';
$js .= '$(document).ready(function(){ $("#" + obj + "enus-title").syncTranslit({destination: obj + "enus-slug", urlSeparator: "-"}); });';

$this->registerJs($js, yii\web\View::POS_READY );
?>