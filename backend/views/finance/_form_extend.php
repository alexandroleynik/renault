<?php
$mId = strtolower($model::getClassNameNoNamespace());
?>


<?php
echo $form->field($model, 'before_body')->textarea(['style' => 'display:none;'])->label(false);
?>

<div class = "row">
    <div class = "col-xs-12 col-sm-12 col-lg-12">
        <?php
        echo common\widgets\jsoneditor\JsonEditor::widget([
            'fieldId'   => $mId . '-before_body',
            'schemaUrl' => Yii::getAlias('@web/js/json-editor/schema/finance.before_body.json')
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
            'schemaUrl' => Yii::getAlias('@web/js/json-editor/schema/finance.after_body.json')
            //'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=page-body.json')
        ]);
        ?>
    </div>
</div>

<?php echo $form->field($model, 'status')->checkbox() ?>
