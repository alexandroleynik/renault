<?php

namespace backend\controllers;

use Yii;
use common\models\Model;
use backend\models\search\ModelSearch;
use \common\models\ModelCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\base\MultiModel;
use common\models\ModelCategories;
use common\models\Info;

/**
 * ModelController implements the CRUD actions for Model model.
 */
class ModelController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ]
            ]
        ];
    }

    /**
     * Lists all Model models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel        = new ModelSearch();
        $searchModel->detachBehaviors();
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['published_at' => SORT_DESC]
        ];

        $models = Model::find()
            ->andFilterWhere([
                'domain_id' => Yii::getAlias('@defaultDomainId'),
                'locale'    => 'uk-UA'
            ])
            ->all();

        $list = \yii\helpers\ArrayHelper::map($models, 'locale_group_id', 'title');

//        $dataProvider->query->andFilterWhere([ 'locale' => Yii::$app->language]);
        $dataProvider->query->andFilterWhere(['!=', 'locale', 'en-US']);

        return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
                'list'         => $list
        ]);
    }

    /**
     * Creates a new Model model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentModel         = Model::getLocaleInstance($key);
            $currentModel->locale = $key;

            if (Yii::$app->request->get('scenario')) {
                $currentModel->on_scenario = Yii::$app->request->get('scenario');
            }

            $models[$key] = $currentModel;
        }

        //set data from default model
        if (Yii::$app->request->get('locale_group_id')) {

            $defaultDomainModels = Model::find()
                ->andFilterWhere([
                    'domain_id'       => Yii::getAlias('@defaultDomainId'),
                    'locale_group_id' => Yii::$app->request->get('locale_group_id')
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
                $models[$value->locale]->price       = $value->price;
                $models[$value->locale]->description = $value->description;
                $models[$value->locale]->thumbnail   = $value->thumbnail;
                $models[$value->locale]->before_body = $value->before_body;
                $models[$value->locale]->after_body  = $value->after_body;
            }
        }

        $model = new MultiModel([
            'models' => $models
        ]);

        if ($model->load(Yii::$app->request->post()) && Model::multiSave($model)) {
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
                    'model'      => $model,
                    'categories' => ModelCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
            ]);
        }
    }

    /**
     * Updates an existing Model model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $firstModel = $this->findModel($id);

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentModel              = Model::getLocaleInstance($key);
            $dataModel                 = $currentModel::find()
                ->andWhere([
                    'locale_group_id' => $firstModel->locale_group_id,
                    'locale'          => $key
                ])
                ->one();
            $dataModel->categoriesList = $this->getCategoriesListIds($dataModel->id);

            if (!empty($dataModel->domain)) {
                $dataModel->domain = explode(',', $dataModel->domain);
            }

            $models[$key] = $dataModel;

            if (!$models[$key]) {
                $currentModel->attributes  = $firstModel->attributes;
                $currentModel->attachments = $firstModel->attachments;

                $currentModel->thumbnail = $firstModel->thumbnail;
                //TODO: thumbnail copy fix

                $currentModel->categoriesList  = $firstModel->categoriesList;
                //$currentModel->video = $firstModel->video;
                $currentModel->locale_group_id = $firstModel->locale_group_id;
                $currentModel->locale          = $key;
                $currentModel->title           = 'title ' . $key . ' ' . time();
                $currentModel->descripton      = $firstModel->description;
                $currentModel->price           = $firstModel->price;
                $currentModel->slug            = '';

                $models[$key] = $currentModel;
            }
        }

        $model = new MultiModel([
            'models' => $models
        ]);

        if ($model->load(Yii::$app->request->post()) && Model::multiSave($model)) {
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
                    'model'      => $model,
                    'categories' => ModelCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
            ]);
        }
    }

    /**
     * Deletes an existing Model model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

        $infoModel = Info::find()->andWhere(['model_id' => $id])->one();

        if (null === $infoModel) {
            $this->findModel($id)->delete();
        } else {
            Yii::$app->session->setFlash('alert', [
                'body'    => \Yii::t('backend', 'Can not delete model #' . $id . '. It used in other table. Delete info page #' . $infoModel->id . ' first.'),
                'options' => ['class' => 'alert-error']
            ]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Model model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Model the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function getCategoriesListIds($id)
    {
        $arr = [];

        $models = ModelCategories::find()->andWhere(['model_id' => $id])->all();

        foreach ($models as $model) {
            $arr[] = $model->category_id;
        }

        return $arr;
    }
}