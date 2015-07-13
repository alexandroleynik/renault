<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Promo */

/*$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Promo',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Promos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');*/
?>
<div class="promo-update">

    <?php echo $this->render('_tab', [
        'model' => $model,
        'categories' => $categories,
        'domains' => $domains
    ]) ?>

</div>
