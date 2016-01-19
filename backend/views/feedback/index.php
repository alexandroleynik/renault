<?php
use yii\grid\GridView;
use yii\helpers\Html;


//\yii\helpers\VarDumper::dump(\Yii::$app->user->identity , 11, true);
//\yii\helpers\VarDumper::dump((array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))) , 11, true);
//\yii\helpers\VarDumper::dump($searchModel , 11, true);
//\yii\helpers\VarDumper::dump($feedbacks , 11, true);?>
<a class="btn btn-default" href="/feedback/create"><?= Yii::t('backend', 'Add question') ?></a>
<?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [

            'id',
            'text',
            'dealers_id',
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
                'template' => '{update} {delete}',

            ]
        ]
    ]);

