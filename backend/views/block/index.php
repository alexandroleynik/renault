<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('backend', 'Blocks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <a class="btn btn-default" href="/block/create"><?= Yii::t('backend', 'Create block'); ?></a>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Clone block'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/block/create?locale_group_id=' . $key . '">' . $value . '</a></li>';
            }
            ?>

        </ul>
    </span>

        <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Extend block'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/block/create?locale_group_id=' . $key . '&scenario=extend">' . $value . '</a></li>';
            }
            ?>

        </ul>
    </span>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [

            'id',
            'slug',
            'title',
            'description',
            [
                'class'     => \common\grid\EnumColumn::className(),
                'attribute' => 'status',
                'enum'      => [
                    Yii::t('backend', 'Not Published'),
                    Yii::t('backend', 'Published')
                ]
            ],
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ]
        ]
    ]);
    ?>

</div>
