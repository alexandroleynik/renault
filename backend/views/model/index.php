8<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Models');
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
<div class="model-index">

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <a class="btn btn-default" href="/model/create"><?= Yii::t('backend', 'Create model'); ?></a>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Clone model'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/model/create?locale_group_id=' . $key . '">' . $value . '</a></li>';
            }
            ?>

        </ul>
    </span>

    <?php
    $columns = [
        'id',
        'title',
        'slug',
        'price',
        'created_at:datetime',
        [
            'class' => \common\grid\EnumColumn::className(),
            'attribute' => 'status',
            'enum' => [
                Yii::t('backend', 'Not Published'),
                Yii::t('backend', 'Published')
            ]
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {pages} {log} {delete}',
            'buttons' => [
                'pages' => function ($url, $model) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['info/index', 'mid' => $model['id']]);
                    return Html::a('<span class="glyphicon glyphicon glyphicon-list-alt"></span>', $customurl, ['title' => Yii::t('yii', 'Pages'), 'data-pjax' => '0']);
                },
                'log' => function ($url, $model) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['timeline-event/index', 'TimelineEventSearch[category]' => 'common\models\locale\Model', 'TimelineEventSearch[row_id]' => $model->id]);
                    return Html::a('<span class="glyphicon glyphicon-time"></span>', $customurl, ['title' => Yii::t('yii', 'Log'), 'data-pjax' => '0']);
                }
            ]
        ]
    ];
    if (\Yii::$app->user->can('administrator')) {
        // adding after price
        array_splice($columns, 4, 0, [[
            'attribute' => 'domain_id',
            'content' => function ($model) {
                $domain = Domain::findOne($model->domain_id);
                $domain = $domain ? $domain->title : '';
                return Html::tag(
                    'div',
                    $model->domain_id,
                    [
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'left',
                        'title' => $domain,
                        'style' => 'cursor:default;'
                    ]
                );
            }
        ]]);
    }
    //\yii\helpers\VarDumper::dump($dataProvider , 11, true);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            'slug',
            'price', 'category_id', 'author_id', 'status', 'weight', 'domain_id'
            ,
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {log} {delete}',
                'buttons' => [
                    'log' => function ($url, $model) {
                        $customurl = Yii::$app->getUrlManager()->createUrl(['timeline-event/index', 'TimelineEventSearch[category]' => 'common\models\locale\Page', 'TimelineEventSearch[row_id]' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-time"></span>', $customurl, ['title' => Yii::t('yii', 'Log'), 'data-pjax' => '0']);
                    }
                ]
            ]
            ]
        ]);
    ?>

</div>
