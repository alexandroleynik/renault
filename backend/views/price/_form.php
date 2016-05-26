<?php

use \yii\helpers\ArrayHelper;



?>

<?php echo $form->field($model, 'model')->textInput(['maxlength' => 512]) ?>
<?php echo $form->field($model, 'version')->textInput(['maxlength' => 512]) ?>
<?php echo $form->field($model, 'version_code')->textInput(['maxlength' => 512]) ?>
<?php echo $form->field($model, 'body_type')->textInput(['maxlength' => 512]) ?>
<?php echo $form->field($model, 'price')->textInput(['maxlength' => 512]) ?>

<?php

?>

<?php
echo $form->field($model, 'weight')
    ->hint(Yii::t('backend', 'Used for sorting'))
    ->textInput(['maxlength' => 1024])
?>

<?php

?>

<?php echo $form->field($model, 'status')->checkbox() ?>

