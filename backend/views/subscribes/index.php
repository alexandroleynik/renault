<?php

use yii\helpers\Html;

use common\models\Domain;
use kartik\export\ExportMenu;


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
         'created_at:datetime',

        [
            'class'    => '\kartik\grid\ActionColumn',
            'template' => '{delete}',

        ]
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
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $columns,
                'target' => ExportMenu::TARGET_SELF,
                'showConfirmAlert' => false,
                'showColumnSelector' => false,
                'exportConfig' => [
                    ExportMenu::FORMAT_EXCEL => false,
                ],
            ]),
            '{toggleData}'
        ],
        'panel' => [
            'type' => \kartik\grid\GridView::TYPE_PRIMARY,
        ],
    ]);
//    echo GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel'  => $searchModel,
//        'columns'      => $columns,
//        ]);
        ?>

</div>