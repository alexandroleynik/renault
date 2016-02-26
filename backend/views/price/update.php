<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Model */

/*$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Model',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');*/
?>
<div class="model-update">

    <?php echo $this->render('_tab', [
        'model' => $model,

        'domains' => $domains
    ]) ?>

</div>
