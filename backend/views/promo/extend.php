<?php
/* @var $this yii\web\View */
/* @var $model common\models\Promo */
/* @var $categories common\models\PromoCategory[] */

$this->title = Yii::t('backend', 'Extend {modelClass}', [
    'modelClass' => 'Promo',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Promos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-create">

    <?php echo $this->render('_tab_extend', [
        'model' => $model,
        'categories' => $categories,
        'domains' => $domains
    ]) ?>

</div>
