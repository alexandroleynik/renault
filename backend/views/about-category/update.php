<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModelCategory */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'About Category',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'About Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="model-category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
