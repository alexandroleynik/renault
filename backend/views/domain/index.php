<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\DomainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Domains');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domain-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create Domain'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            'dealer_id',
            [
                'attribute' => 'search_date_created',
                'label' => 'Создано',
                'value' => 'created_at',
                'format' => ['date', 'php:d-m-Y']
            ],
            [
                'attribute' => 'search_date_updated',
                'label' => 'Обновлено',
                'value' => 'updated_at',
                'format' => ['date', 'php:d-m-Y']
            ],
            //'created_at:datetime',
            //'updated_at:datetime',
             
            // 'status',
            // 'locale',
            // 'locale_group_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
