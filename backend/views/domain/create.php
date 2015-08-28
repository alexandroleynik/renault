<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Domain */

$this->title = Yii::t('frontend', 'Create Domain');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Domains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
