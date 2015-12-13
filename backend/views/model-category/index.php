<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\\models\search\ModelCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('backend', 'Model Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <a class="btn btn-default" href="/model-category/create"><?= Yii::t('backend', 'Create category'); ?></a>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Clone category'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/model-category/create?source_id=' . $key . '">' . $value . '</a></li>';
            }
            ?>

        </ul>
    </span>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'slug',
            'status',
            'weight',
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]);
    ?>

</div>
