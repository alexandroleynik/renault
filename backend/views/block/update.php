<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Block */

/*$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Block',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');*/
?>
<div class="block-update">

    <?php echo $this->render('_tab', [
        'model' => $model,        
        'domains' => $domains
    ]) ?>

</div>
