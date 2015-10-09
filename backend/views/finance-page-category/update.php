<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\InfoCategory */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Finance page Category',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Finance page Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="info-category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
