<?php
/* @var $this yii\web\View */
/* @var $model common\models\Model */
/* @var $categories common\models\ModelCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Model',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-create">

    <?php echo $this->render('_tab', [
        'model' => $model,
        'categories' => $categories,
        'domains' => $domains
    ]) ?>

</div>
