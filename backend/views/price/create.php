<?php
/* @var $this yii\web\View */
/* @var $model common\models\Model */
/* @var $categories common\models\ModelCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Price',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Price'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-create">

    <?php echo $this->render('_tab', [
        'model' => $model,
        'domains' => $domains
    ]) ?>

</div>
