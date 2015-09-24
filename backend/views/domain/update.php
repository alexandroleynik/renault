<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Domain */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'Domain',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Domains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="domain-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dealerItems' => $dealerItems
    ]) ?>

</div>
