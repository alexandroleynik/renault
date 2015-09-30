<?php
/* @var $this yii\web\View */
/* @var $model common\models\InfoCategory */
/* @var $categories common\models\InfoCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Service page Category',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Service page Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
