<?php

namespace backend\controllers;

use Yii;
use common\models\ServicePage;
use backend\models\search\ServicePageSearch;
use \common\models\ServicePageCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\base\MultiModel;
use common\models\ServicePageCategories;
use common\models\Service;

/**
 * ServicePageController implements the CRUD actions for ServicePage model.
 */
class ServicePageController extends Controller
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
     * Lists all ServicePage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel        = new ServicePageSearch();
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['published_at' => SORT_DESC]
        ];

        $dataProvider->query->andFilterWhere([ 'locale' => Yii::$app->language]);

        if (Yii::$app->request->get('mid')) {
            $parentModel = Service::findOne(['id' => Yii::$app->request->get('mid')]);

            $models = ServicePage::find()
                ->andFilterWhere([
                    'domain_id' => Yii::getAlias('@defaultDomainId'),
                    'locale'    => 'uk-UA',
                ])
                ->andWhere(['like', 'slug', $parentModel->slug])
                ->all();
        } else {
            $models = ServicePage::find()
                ->andFilterWhere([
                    'domain_id' => Yii::getAlias('@defaultDomainId'),
                    'locale'    => 'uk-UA',
                ])
                ->all();
        }

        $list = \yii\helpers\ArrayHelper::map($models, 'locale_group_id', 'title');


        return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
                'list'         => $list
        ]);
    }

    /**
     * Creates a new ServicePage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentModel         = ServicePage::getLocaleInstance($key);
            $currentModel->locale = $key;

            if (Yii::$app->request->get('scenario')) {
                $currentModel->on_scenario = Yii::$app->request->get('scenario');
            }

            $models[$key] = $currentModel;
        }

        //set data from default model
        if (Yii::$app->request->get('locale_group_id')) {

            $defaultDomainModels = ServicePage::find()
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
                $models[$value->locale]->description = $value->description;
                $models[$value->locale]->before_body = $value->before_body;
                $models[$value->locale]->after_body  = $value->after_body;
            }
        }

        $model = new MultiModel([
            'models' => $models
        ]);

        if ($model->load(Yii::$app->request->post()) && ServicePage::multiSave($model)) {
            return $this->redirect(['index', 'mid' => $model->getModel(Yii::$app->language)->service_id]);
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
                    'categories' => ServicePageCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
            ]);
        }
    }

    /**
     * Updates an existing ServicePage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $firstModel = $this->findModel($id);

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentModel              = ServicePage::getLocaleInstance($key);
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
                $currentModel->attributes      = $firstModel->attributes;
                $currentModel->attachments     = $firstModel->attachments;
                $currentModel->thumbnail       = $firstModel->thumbnail;
                $currentModel->categoriesList  = $firstModel->categoriesList;
                //$currentModel->video = $firstModel->video;
                $currentModel->locale_group_id = $firstModel->locale_group_id;
                $currentModel->locale          = $key;
                $currentModel->title           = 'title ' . $key . ' ' . time();
                $currentModel->descripton      = $firstModel->description;
                $currentModel->service_id      = $firstModel->service_id;
                $currentModel->slug            = '';

                $models[$key] = $currentModel;
            }
        }

        $model = new MultiModel([
            'models' => $models
        ]);

        if ($model->load(Yii::$app->request->post()) && ServicePage::multiSave($model)) {
            return $this->redirect(['index', 'mid' => $model->getModel(Yii::$app->language)->service_id]);
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
                    'categories' => ServicePageCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
            ]);
        }
    }

    /**
     * Deletes an existing ServicePage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $mid = $this->findModel($id)->service_id;

        $this->findModel($id)->delete();

        return $this->redirect(['index', 'mid' => $mid]);
    }

    /**
     * Finds the ServicePage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServicePage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServicePage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function getCategoriesListIds($id)
    {
        $arr = [];

        $models = ServicePageCategories::find()->andWhere(['service_page_id' => $id])->all();

        foreach ($models as $model) {
            $arr[] = $model->category_id;
        }

        return $arr;
    }
}