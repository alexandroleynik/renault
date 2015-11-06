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
            'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=model-before_body&language=' . Yii::$app->language . '&domain_id=' . \Yii::$app->user->identity->domain_id)
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
            'schemaUrl' => Yii::getAlias('@apiUrl/file/schema/view?id=model-after_body&language=' . Yii::$app->language . '&domain_id=' . \Yii::$app->user->identity->domain_id)
        ]);
        ?>
    </div>
</div>

<?php echo $form->field($model, 'status')->checkbox() ?>
