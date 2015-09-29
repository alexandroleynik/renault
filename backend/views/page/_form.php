<?php
$mId = strtolower($model::getClassNameNoNamespace());
?>

<?php echo $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

<?php echo $form->field($model, 'slug')->textInput(['maxlength' => 2048]) ?>

<?php
echo $form->field($model, 'head')->textarea(['style' => 'display:none;'])->label(false);
?>

<div class = "row">
    <div class = "col-xs-12 col-sm-12 col-lg-12">
        <?php
        echo common\widgets\jsoneditor\JsonEditor::widget([
            'fieldId'   => $mId . '-head',
            'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=page-head')
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
            'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=page-body')            
        ]);
        ?>
    </div>
</div>

<?php echo $form->field($model, 'status')->checkbox() ?>

