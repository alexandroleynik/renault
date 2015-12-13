<?php
/* @var $this yii\web\View */
/* @var $model common\models\WidgetText */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Custom Code',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Custom Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-block-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
