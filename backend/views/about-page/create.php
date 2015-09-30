<?php
/* @var $this yii\web\View */
/* @var $model common\models\Info */
/* @var $categories common\models\InfoCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'About page',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Info'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-create">

    <?php echo $this->render('_tab', [
        'model' => $model,
        'categories' => $categories,
        'domains' => $domains
    ]) ?>

</div>
