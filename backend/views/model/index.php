<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('backend', 'Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <a class="btn btn-default" href="/model/create"><?= Yii::t('backend', 'Create model'); ?></a>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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

        <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Extend model'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/model/create?locale_group_id=' . $key . '&scenario=extend">' . $value . '</a></li>';
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
            'price',
            'created_at:datetime',
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
                'template' => '{update} {pages} {delete}',
                'buttons'  => [
                    'pages' => function ($url, $model) {
                        $customurl = Yii::$app->getUrlManager()->createUrl(['info/index', 'mid' => $model['id']]);
                        return Html::a('<span class="glyphicon glyphicon glyphicon-list-alt"></span>', $customurl, ['title' => Yii::t('yii', 'Pages'), 'data-pjax' => '0']);
                    }
                    ]
                ]
            ]
        ]);

        /*
         *   [
          'class'    => 'yii\grid\ActionColumn',
          'template' => '{view}',
          'buttons'  => [
          'view' => function ($url, $model) {
          $customurl = Yii::$app->getUrlManager()->createUrl(['coin/investment-view', 'address' => $model['swa']]);
          return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $customurl, ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
          }
          ]
          ],
          ],
         */
        ?>

</div>
