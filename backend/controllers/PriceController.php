<?php

namespace backend\controllers;

use Yii;
use common\models\Price;
use backend\models\search\PriceSearch;
use common\components\excell;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\base\MultiModel;



/**
 * ModelController implements the CRUD actions for Model model.
 */
class PriceController extends Controller
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
        $searchModel        = new PriceSearch();
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);
//        $dataProvider->sort = [
//            'defaultOrder' => ['published_at' => SORT_DESC]
//        ];

        $prices = Price::find()
            ->andFilterWhere([
                'domain_id' => Yii::getAlias('@defaultDomainId'),
                'locale'    => 'uk-UA'
            ])
            ->all();

        $list = \yii\helpers\ArrayHelper::map($prices, 'locale_group_id', 'model');

//        $dataProvider->query->andFilterWhere([ 'locale' => Yii::$app->language]);

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
            $currentModel         = Price::getLocaleInstance($key);
            $currentModel->locale = $key;

            if (Yii::$app->request->get('scenario')) {
                $currentModel->on_scenario = Yii::$app->request->get('scenario');
            }

            $models[$key] = $currentModel;
        }

        //set data from default model
        if (Yii::$app->request->get('locale_group_id')) {

            $defaultDomainModels = Price::find()
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

                $models[$value->locale]->model        = $value->model;
                $models[$value->locale]->version_code       = $value->version_code;
                $models[$value->locale]->body_type        = $value->body_type;
                $models[$value->locale]->body        = $value->body;
                $models[$value->locale]->price       = $value->price;

            }
        }

        $model = new MultiModel([
            'models' => $models
        ]);

\yii\helpers\VarDumper::dump(Yii::$app->request->post(), 11, 1);
        if ($model->load(Yii::$app->request->post()) && Price::multiSave($model)) {
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
            $currentModel              = Price::getLocaleInstance($key);
            $dataModel                 = $currentModel::find()
                ->andWhere([
                    'locale_group_id' => $firstModel->locale_group_id,
                    'locale'          => $key
                ])
                ->one();
//            $dataModel->categoriesList = $this->getCategoriesListIds($dataModel->id);

            if (!empty($dataModel->domain)) {
                $dataModel->domain = explode(',', $dataModel->domain);
            }

            $models[$key] = $dataModel;

            if (!$models[$key]) {
                $currentModel->model        = $value->model;
                $currentModel->version_code       = $value->version_code;
                $currentModel->body_type        = $value->body_type;

                $currentModel->price       = $value->price;

                $currentModel->locale_group_id = $firstModel->locale_group_id;
                $currentModel->locale          = $key;
               

                $models[$key] = $currentModel;
            }
        }

        $model = new MultiModel([
            'models' => $models
        ]);

        if ($model->load(Yii::$app->request->post()) && Price::multiSave($model)) {
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

    public function actionImport() {
        $model = new Price();
//        Price::deleteAll();
        $model->importExcel();

//        \yii\helpers\VarDumper::dump($model, 9, 9); die();
        return $this->render('import', [ 'model' => $model ]);
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