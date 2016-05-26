<?php
use yii\grid\GridView;
use yii\helpers\Html;

//echo ;

//\yii\helpers\VarDumper::dump(\Yii::$app->user->identity->id , 11, true);
//\yii\helpers\VarDumper::dump((array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))) , 11, true);
//\yii\helpers\VarDumper::dump($searchModel , 11, true);
//\yii\helpers\VarDumper::dump(\api\models\User::findOne(1) , 11, true);?>
    <a class="btn btn-default" href="/emailf/create"><?= Yii::t('backend', 'Add email address') ?></a>
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'email',
        //'created_at:datetime',
        [
            'attribute' => 'search_date_created',
            'label' => 'Создано',
            'value' => 'created_at',
            'format' => ['date', 'php:d-m-Y']
        ],
        [
            'class' => \common\grid\EnumColumn::className(),
            'attribute' => 'status',
            'enum' => [
                Yii::t('backend', 'off'),
                Yii::t('backend', 'on')
            ]
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ]
    ]
]);

