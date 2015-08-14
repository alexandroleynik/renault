<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\InfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Info');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php

        $createUrl = ['create'];

        if (!empty(Yii::$app->request->queryParams['mid'])) {
            $createUrl['mid'] = Yii::$app->request->queryParams['mid'];
        }

        echo Html::a(
            Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'Info']),
            $createUrl,
            ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'slug',
            'title',            
           /* [
                'attribute'=>'category_id',
                'value'=>function ($model) {
                    return $model->category ? $model->category->title : null;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\InfoCategory::find()->all(), 'id', 'title')
            ],*/            
            [
                'class'=>\common\grid\EnumColumn::className(),
                'attribute'=>'status',
                'enum'=>[
                    Yii::t('backend', 'Not Published'),
                    Yii::t('backend', 'Published')
                ]
            ],
            'published_at:datetime',
            //'created_at:datetime',
            'weight',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}'
            ]
        ]
    ]); ?>

</div>
