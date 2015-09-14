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

            if (!empty(Yii::$app->request->get('scenario'))) {
                $currentModel->on_scenario = Yii::$app->request->get('scenario');
            }

            $models[$key] = $currentModel;
        }

        //set data from default model
        if (Yii::$app->request->get('locale_group_id')) {

            $defaultDomainModels = Page::find()
                ->andFilterWhere([
                    'domain_id'       => Yii::getAlias('@defaultDomainId'),
                    'locale_group_id' => Yii::$app->request->get('locale_group_id')
                ])
                ->all();

            foreach ($defaultDomainModels as $key => $value) {
                $models[$value->locale]->slug        = $value->slug;
                $models[$value->locale]->title       = $value->title;
                $models[$value->locale]->head        = $value->head;
                $models[$value->locale]->body        = $value->body;
                $models[$value->locale]->before_body = $value->before_body;
                $models[$value->locale]->after_body  = $value->after_body;
            }
        }

        $model = new MultiModel([
            'models' => $models
        ]);

        if ($model->load(Yii::$app->request->post()) && Page::multiSave($model)) {
            return $this->redirect(['index']);
        } else {
            switch (Yii::$app->request->get('scenario')) {
                case 'extend' :
                    $viewName = 'extend';
                    break;
                default :
                    $viewName = 'create';
            }

            return $this->render($viewName, [
                    'model' => $model
            ]);
        }
    }

}