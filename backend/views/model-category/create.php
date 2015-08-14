<?php
/* @var $this yii\web\View */
/* @var $model common\models\ModelCategory */
/* @var $categories common\models\ModelCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Model Category',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Model Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
