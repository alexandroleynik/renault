<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

/*$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Page',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');*/
?>
<div class="page-update">

    <?php echo $this->render('_tab', [
        'model' => $model,
    ]) ?>

</div>
