<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\InfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('backend', 'Info');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    $additionalGetParam            = '';
    if (!empty(Yii::$app->request->queryParams['mid'])) {
        $additionalGetParam = 'mid=' . Yii::$app->request->queryParams['mid'];
    }
    ?>



    <a class="btn btn-default" href="/info/create?<?= $additionalGetParam ?>"><?= Yii::t('backend', 'Create model page'); ?></a>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Clone model page'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/info/create?locale_group_id=' . $key . '&' . $additionalGetParam . '">' . $value . '</a></li>';
            }
            ?>

        </ul>
    </span>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Extend model page'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/info/create?locale_group_id=' . $key . '&' . $additionalGetParam . '&scenario=extend">' . $value . '</a></li>';
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
            /* [
              'attribute'=>'category_id',
              'value'=>function ($model) {
              return $model->category ? $model->category->title : null;
              },
              'filter'=>\yii\helpers\ArrayHelper::map(\common\models\InfoCategory::find()->all(), 'id', 'title')
              ], */
            [
                'class'     => \common\grid\EnumColumn::className(),
                'attribute' => 'status',
                'enum'      => [
                    Yii::t('backend', 'Not Published'),
                    Yii::t('backend', 'Published')
                ]
            ],
            'published_at:datetime',
            //'created_at:datetime',
            'weight',
                    [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{update} {log} {delete}',
                'buttons'  => [
                    'log' => function ($url, $model) {
                        $customurl = Yii::$app->getUrlManager()->createUrl(['timeline-event/index', 'TimelineEventSearch[category]' => 'common\models\locale\Info', 'TimelineEventSearch[row_id]' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-time"></span>', $customurl, ['title' => Yii::t('yii', 'Log'), 'data-pjax' => '0']);
                    }
                    ]
                ]
        ]
    ]);
    ?>

</div>
