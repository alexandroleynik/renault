<?php
/* @var $this yii\web\View */
/* @var $model common\models\PromoCategory */
/* @var $categories common\models\PromoCategory[] */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Promo Category',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Promo Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
