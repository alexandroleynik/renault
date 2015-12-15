<?php




/* @var $this yii\web\View */
/* @var $searchModel \backend\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('backend', 'Corporate Sales');
$this->params['breadcrumbs'][] = $this->title;
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
        'message',

        [
            'class'    => '\kartik\grid\ActionColumn',
            'template' => '{delete}',
        ]
    ];

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

        ?>

</div>