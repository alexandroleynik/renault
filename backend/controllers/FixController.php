<?php

namespace backend\controllers;

use Yii;
use common\models\Page;
use backend\models\search\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\base\MultiModel;

/**
 * PageController implements the CRUD actions for Page model.
 */
class FixController extends Controller
{
    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->andFilterWhere([ 'locale' => Yii::$app->language]);

        $models = Page::find()
            ->andFilterWhere([
                'domain_id' => Yii::getAlias('@defaultDomainId'),
                'locale'    => 'uk-UA'
            ])
            ->all();

        $list = \yii\helpers\ArrayHelper::map($models, 'locale_group_id', 'title');

        return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
                'list'         => $list
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentModel         = Page::getLocaleInstance($key);
            $currentModel->locale = $key;

            
        }
    }

}