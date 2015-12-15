<?php

use yii\helpers\Html;

use common\models\Domain;


/* @var $this yii\web\View */
/* @var $searchModel \backend\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('backend', 'Subscribes');
$this->params['breadcrumbs'][] = $this->title;
//$js = <<< 'SCRIPT'
//    $(function () {
//        $("[data-toggle='tooltip']").tooltip();
//    });;
//    $(function () {
//        $("[data-toggle='popover']").popover();
//    });
//SCRIPT;
//$this->registerJs($js);
?>
<div class="page-index">

    <?php
    $columns = [
        'id',
        'firstname',
        'secondname',
        'lastname',
        'email',

        'phone',

//        [
//            'class'    => 'yii\grid\ActionColumn',
//            'template' => '{delete}',
//            'buttons'  => [
//                'log' => function ($url, $model) {
//                    $customurl = Yii::$app->getUrlManager()->createUrl(['timeline-event/index', 'TimelineEventSearch[category]' => 'common\models\locale\Page', 'TimelineEventSearch[row_id]' => $model->id]);
//                    return Html::a('<span class="glyphicon glyphicon-time"></span>', $customurl, ['title' => Yii::t('yii', 'Log'), 'data-pjax' => '0']);
//                }
//            ]
//        ]
    ];
//    if (\Yii::$app->user->can('administrator')) {
//        // adding after status
//        array_splice($columns, 4, 0, [[
//            'attribute' => 'domain_id',
//            'content'=> function($model) {
//                $domain = Domain::findOne($model->domain_id);
//                $domain = $domain?$domain->title:'';
//                return Html::tag(
//                            'div',
//                            $model->domain_id,
//                            [
//                                'data-toggle' => 'tooltip',
//                                'data-placement' => 'left',
//                                'title'=> $domain,
//                                'style'=> 'cursor:default;'
//                            ]
//                );
//            }
//        ]]);
//    }
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
        'toolbar'=>[
            '{export}',
            '{toggleData}'
        ],
        'panel' => [
            'type' => \kartik\grid\GridView::TYPE_PRIMARY
        ],
    ]);
//    echo GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel'  => $searchModel,
//        'columns'      => $columns,
//        ]);
        ?>

</div>