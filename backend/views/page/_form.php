<?php
$mId = strtolower($model::getClassNameNoNamespace());
?>

<?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

<?php echo $form->field($model, 'slug')->textInput(['maxlength' => 2048]) ?>

<?php
echo $form->field($model, 'head')->textarea(['style' => 'display:none;'])->label(false);

echo common\widgets\jsoneditorcss\JsonEditorCss::widget([
    'fieldId' => $mId . '-head',
    'options' => [
        'schema' => json_decode(file_get_contents(Yii::getAlias('@common/widgets/jsoneditorcss/assets/schema/backend.page.head.json')), true)
    ]
]);
?>

<?php
echo $form->field($model, 'before_body')->textarea(['style' => 'display:none;'])->label(false);
?>

<div class = "row">
    <div class = "col-xs-12 col-sm-12 col-lg-12">
        <?php
        echo common\widgets\jsoneditor\JsonEditor::widget([
            'fieldId'   => $mId . '-before_body',
            'schemaUrl' => Yii::getAlias('@web/js/json-editor/schema/page.before_body.json')
            //'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=page-body.json')
        ]);
        ?>
    </div>
</div>

<?php
echo $form->field($model, 'body')->textarea(['style' => 'display:none;'])->label(false);
?>

<div class = "row">
    <div class = "col-xs-12 col-sm-12 col-lg-12">
        <?php
        echo common\widgets\jsoneditor\JsonEditor::widget([
            'fieldId'   => $mId . '-body',
            'schemaUrl' => Yii::getAlias('@web/js/json-editor/schema/page.body.json')
            //'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=page-body.json')
        ]);
        ?>
    </div>
</div>

<?php
echo $form->field($model, 'after_body')->textarea(['style' => 'display:none;'])->label(false);
?>

<div class = "row">
    <div class = "col-xs-12 col-sm-12 col-lg-12">
        <?php
        echo common\widgets\jsoneditor\JsonEditor::widget([
            'fieldId'   => $mId . '-after_body',
            'schemaUrl' => Yii::getAlias('@web/js/json-editor/schema/page.after_body.json')
            //'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=page-body.json')
        ]);
        ?>
    </div>
</div>

<?php echo $form->field($model, 'status')->checkbox() ?>

