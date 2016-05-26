<?php
/* @var $this yii\web\View */
/* @var $model common\models\Info */
/* @var $categories common\models\InfoCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Email',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Email'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-create">

    <?php echo $this->render('_form', [
        'model' => $model,

    ]) ?>

</div>