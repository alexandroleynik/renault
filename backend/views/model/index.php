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

    <p>
        <?php
        echo Html::a(
            Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'Model']), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

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
