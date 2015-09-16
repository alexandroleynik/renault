<?php
/**
 * @author Eugene Fabrikov <eugene.fabrikov@gmail.com>
 */
$this->title = Yii::t('backend', 'Application settings');
echo \common\components\keyStorage\FormWidget::widget([
    'model' => $model,
    'formClass' => '\yii\bootstrap\ActiveForm',
    'submitText' => Yii::t('backend', 'Save'),
    'submitOptions' => ['class' => 'btn btn-primary']
]);
