<?php

use yii\helpers\Html;
use yii\helpers\Arrayhelper;
use yii\grid\GridView;
use common\models\Domain;
use common\models\Model;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\InfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$cid = $_GET["InfoSearch"]["cid"];

switch ($cid) {
    case '':
        $name = 'All';
        break;
    case 1:
        $name = 'light_auto';
        break;
    case 2:
        $name = 'commerce_auto';
        break;
}

$this->title                   = Yii::t('backend', 'Info');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['info/index']];
$this->params['breadcrumbs'][] = Yii::t('backend',$name);



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
<div class="info-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
    $additionalGetParam            = '';
    if (!empty(Yii::$app->request->queryParams['mid'])) {
        $additionalGetParam = 'mid=' . Yii::$app->request->queryParams['mid'];
    }

    if (!empty(Yii::$app->request->queryParams['InfoSearch']['model_id'])) {
        $additionalGetParam = 'mid=' . Yii::$app->request->queryParams['InfoSearch']['model_id'];
    }
    ?>


<?php if (!empty($additionalGetParam)) { ?>
    <a class="btn btn-default" href="/info/create?<?= $additionalGetParam ?>"><?= Yii::t('backend', 'Create model page'); ?></a>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Clone model page'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/info/create?locale_group_id=' . $key . '&' . $additionalGetParam . '">' . $value . '</a></li>';
            }
            ?>

        </ul>
    </span>

    <span class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?= Yii::t('backend', 'Extend model page'); ?>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            foreach ($list as $key => $value) {
                echo '<li><a href="/info/create?locale_group_id=' . $key . '&' . $additionalGetParam . '&scenario=extend">' . $value . '</a></li>';
            }
            ?>

        </ul>
    </span>
<?php } ?>
    <?php

    $campuses = Model::find()->orderBy('title')->where(['locale' => Yii::$app->language])->asArray()->all();  

    foreach ($campuses as $key => $value) {
        $id    = $value['id'];
        $title = $value['title'];
        $user  = User::findIdentity($value['author_id']);
        $user  = $user->username;

        $data[] = [
            'id' => $id,
            'title' => $title."(".$user.")",
        ];
    }

    $columns = [
        'id',
        [
            //'class'     => \common\grid\EnumColumn::className(),                
            'attribute' => 'model_id',
            'filter' => Arrayhelper::map($data, 'id', 'title'),
            //'enum'      => $carList
        ],
        'title',
        'slug',
        /* [
          'attribute'=>'category_id',
          'value'=>function ($model) {
          return $model->category ? $model->category->title : null;
          },
          'filter'=>\yii\helpers\ArrayHelper::map(\common\models\InfoCategory::find()->all(), 'id', 'title')
          ], */
        [
            'class'     => \common\grid\EnumColumn::className(),
            'attribute' => 'status',
            'enum'      => [
                Yii::t('backend', 'Not Published'),
                Yii::t('backend', 'Published')
            ]
        ],
        //'published_at:datetime',
        [
            'attribute' => 'search_date_published',
            'label' => 'Дата публикации',
            'value' => 'published_at',
            'format' => ['date', 'php:d-m-Y']
        ],
        //'created_at:datetime',
        //'weight',
        [
            'class'    => 'yii\grid\ActionColumn',
            'template' => '{update} {log} {delete}',
            'buttons'  => [
                'log' => function ($url, $model) {
                    $customurl = Yii::$app->getUrlManager()->createUrl(['timeline-event/index', 'TimelineEventSearch[category]' => 'common\models\locale\Info', 'TimelineEventSearch[row_id]' => $model->id]);
                    return Html::a('<span class="glyphicon glyphicon-time"></span>', $customurl, ['title' => Yii::t('yii', 'Log'), 'data-pjax' => '0']);
                }
            ]
        ]
    ];
    if (\Yii::$app->user->can('administrator')) {
        // adding after url
        array_splice($columns, 4, 0, [[
            'attribute' => 'domain_id',
            'content'=> function($model) {
                $domain = Domain::findOne($model->domain_id);
                $domain = $domain?$domain->title:'';
                return Html::tag(
                            'div',
                            $model->domain_id, 
                            [
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'left',
                                'title'=> $domain,
                                'style'=> 'cursor:default;'
                            ]
                );
            }
        ]]);
    }
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => $columns
    ]);
        ?>

</div>
