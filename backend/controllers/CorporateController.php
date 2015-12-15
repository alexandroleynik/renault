<?php

namespace backend\controllers;

use Yii;
use common\models\Corporate;
use backend\models\search\CorporateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\base\MultiModel;

/**
 * CorporateController implements the CRUD actions for Corporate model.
 */
class CorporateController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Corporate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new CorporateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        $models = Corporate::find()
            ->andFilterWhere([
                'domain_id' => Yii::getAlias('@defaultDomainId'),

            ])
            ->all();

//        $list = \yii\helpers\ArrayHelper::map($models, 'locale_group_id', 'title');

        return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
//                'list'         => $list
        ]);
    }

    /**
     * Creates a new Corporate model.
     * If creation is successful, the browser will be redirected to the 'view' Corporate.
     * @return mixed
     */
    public function actionCreate()
    {
        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentModel         = Corporate::getLocaleInstance($key);
            $currentModel->locale = $key;

            if (Yii::$app->request->get('scenario')) {
                $currentModel->on_scenario = Yii::$app->request->get('scenario');
            }

            $models[$key] = $currentModel;
        }

        //set data from default model
        if (Yii::$app->request->get('locale_group_id')) {

            $defaultDomainModels = Corporate::find()
                ->andFilterWhere([
                    'domain_id'       => Yii::getAlias('@defaultDomainId'),

                ])
                ->all();

            foreach ($defaultDomainModels as $key => $value) {
                if (!in_array(
                        $value->locale, array_keys(
                            Yii::$app->params['availableLocales']
                        )
                    )
                ) {
                    continue;
                };
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

        if ($model->load(Yii::$app->request->post()) && Corporate::multiSave($model)) {
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

    /**
     * Updates an existing Corporate model.
     * If update is successful, the browser will be redirected to the 'view' Corporate.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $firstModel = $this->findModel($id);

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentModel = Corporate::getLocaleInstance($key);
            $models[$key] = $currentModel::find()
                ->andWhere([
                    'locale_group_id' => $firstModel->locale_group_id,
                    'locale'          => $key
                ])
                ->one();

            if (!$models[$key]) {
                $currentModel->attributes      = $firstModel->attributes;
                $currentModel->locale_group_id = $firstModel->locale_group_id;
                $currentModel->locale          = $key;
                $currentModel->title           = 'title ' . $key . ' ' . time();
                $currentModel->slug            = '';

                $models[$key] = $currentModel;
            }
        }
        //\yii\helpers\VarDumper::dump($models,11,1); die();
        $model = new MultiModel([
            'models' => $models
        ]);

        if ($model->load(Yii::$app->request->post()) && Corporate::multiSave($model)) {
            return $this->redirect(['index']);
        } else {
            switch ($firstModel->on_scenario) {
                case 'extend' :
                    $viewName = 'extend';
                    break;
                default :
                    $viewName = 'update';
            }

            return $this->render($viewName, [
                    'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing Corporate model.
     * If deletion is successful, the browser will be redirected to the 'index' Corporate.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Corporate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Corporate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Corporate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested Corporate does not exist.');
        }
    }
}