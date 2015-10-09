<?php
/* @var $this yii\web\View */
/* @var $model common\models\Info */
/* @var $categories common\models\InfoCategory[] */

$this->title = Yii::t('backend', 'Extend {modelClass}', [
    'modelClass' => 'Finance page',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Info'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-create">

    <?php echo $this->render('_tab_extend', [
        'model' => $model,
        'categories' => $categories,
        'domains' => $domains
    ]) ?>

</div>
