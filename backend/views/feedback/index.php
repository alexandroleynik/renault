<?php
use yii\grid\GridView;
use yii\helpers\Html;

//echo ;

//\yii\helpers\VarDumper::dump(\Yii::$app->user->identity->id , 11, true);
//\yii\helpers\VarDumper::dump((array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))) , 11, true);
//\yii\helpers\VarDumper::dump($searchModel , 11, true);
//\yii\helpers\VarDumper::dump(\api\models\User::findOne(1) , 11, true);?>
    <a class="btn btn-default" href="/feedback/create"><?= Yii::t('backend', 'Add question') ?></a>
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        [
            'attribute' => 'subject',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $grid) {
                return Html::a($model->subject, \yii\helpers\Url::toRoute(['view', 'id' => $model->id]), [
                    'class' => 'dads',
                    'target' => '_blank',
                    'data-pjax' => '0',
                ]);
            },
        ],
        [
            'attribute' => 'domain_id',
            'content' => function ($model) {
                $domain = \api\models\User::findOne($model->domain_id);
                $domain = $domain ? $domain->username : '';
                return Html::tag(
                    'div',
                    $domain,
                    [
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'left',
                        'title' => 'username',
                        'style' => 'cursor:default;'
                    ]
                );
            }
        ],
        'created_at:datetime',
        [
            'class' => \common\grid\EnumColumn::className(),
            'attribute' => 'status',
            'enum' => [
                Yii::t('backend', 'not done'),
                Yii::t('backend', 'done')
            ]
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',

        ]
    ]
]);

