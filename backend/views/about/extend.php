<?php
/* @var $this yii\web\View */
/* @var $model common\models\Model */
/* @var $categories common\models\ModelCategory[] */

$this->title = Yii::t('backend', 'Extend {modelClass}', [
    'modelClass' => 'About',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Abouts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-create">

    <?php echo $this->render('_tab_extend', [
        'model' => $model,
        'categories' => $categories,
        'domains' => $domains
    ]) ?>

</div>
