<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Domain;

/* @var $this yii\web\View */
/* @var $searchModel \backend\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('backend', 'Pages');
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
<div class="page-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <a class="btn btn-default" href="/page/create"><?= Yii::t('backend', 'Create page'); ?></a>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Clone page'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">            
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/page/create?locale_group_id=' . $key . '">' . $value . '</a></li>';
            }
            ?>

        </ul>
    </span>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Extend page'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/page/create?locale_group_id=' . $key . '&scenario=extend">' . $value . '</a></li>';
            }
            ?>

        </ul>
    </span>

    <?php
    $columns = [
        'id',
        'title',
        'slug',
        'status',
        [
            'class'    => 'yii\grid\ActionColumn',
            'template' => '{update} {log} {delete}',
            'buttons'  => [
                'log' => function ($url, $model) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['timeline-event/index', 'TimelineEventSearch[category]' => 'common\models\locale\Page', 'TimelineEventSearch[row_id]' => $model->id]);
                    return Html::a('<span class="glyphicon glyphicon-time"></span>', $customurl, ['title' => Yii::t('yii', 'Log'), 'data-pjax' => '0']);
                }
            ]
        ]
    ];
    if (\Yii::$app->user->can('administrator')) {
        // adding after status
        array_splice($columns, 4, 0, [
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
        ]);
    }

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => $columns,
        ]);
        ?>

</div>