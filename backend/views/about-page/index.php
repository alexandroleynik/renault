<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Domain;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\InfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('backend', 'About page');
$this->params['breadcrumbs'][] = $this->title;
$js = <<< 'SCRIPT'
    $(function () {
        $("[data-toggle='tooltip']").tooltip();
    });;
    $(function () {
        $("[data-toggle='popover']").popover();
    });
SCRIPT;
$this->registerJs($js);
?>
<div class="info-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    $additionalGetParam            = '';
    if (!empty(Yii::$app->request->queryParams['mid'])) {
        $additionalGetParam = 'mid=' . Yii::$app->request->queryParams['mid'];
    }
    ?>



    <a class="btn btn-default" href="/about-page/create?<?= $additionalGetParam ?>"><?= Yii::t('backend', 'Create about page'); ?></a>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Clone about page'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/about-page/create?locale_group_id=' . $key . '&' . $additionalGetParam . '">' . $value . '</a></li>';
            }
            ?>

        </ul>
    </span>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Extend about page'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/about-page/create?locale_group_id=' . $key . '&' . $additionalGetParam . '&scenario=extend">' . $value . '</a></li>';
            }
            ?>

        </ul>
    </span>

    <?php
    $columns = [
        'id',
        'title',
        'slug',
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
        //'weight',
                [
            'class'    => 'yii\grid\ActionColumn',
            'template' => '{update} {log} {delete}',
            'buttons'  => [
                'log' => function ($url, $model) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['timeline-event/index', 'TimelineEventSearch[category]' => 'common\models\locale\AboutPage', 'TimelineEventSearch[row_id]' => $model->id]);
                    return Html::a('<span class="glyphicon glyphicon-time"></span>', $customurl, ['title' => Yii::t('yii', 'Log'), 'data-pjax' => '0']);
                }
            ]
        ]
    ];
    if (\Yii::$app->user->can('administrator')) {
        // adding after url
        array_splice($columns, 3, 0, [[
            'attribute' => 'domain_id',
            'content'=> function($model) {
                $domain = Domain::findOne($model->domain_id);
                $domain = $domain?$domain->title:'';
                return Html::tag(
                            'div',
                            $model->domain_id, 
                            [
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'left',
                                'title'=> $domain,
                                'style'=> 'cursor:default;'
                            ]
                );
            }
        ]]);
    }
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns' => $columns
    ]);
    ?>

</div>
