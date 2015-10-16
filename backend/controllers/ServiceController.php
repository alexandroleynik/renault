<?php

namespace backend\controllers;

use Yii;
use common\models\Service;
use backend\models\search\ServiceSearch;
use \common\models\ServiceCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\base\MultiModel;
use common\models\ServiceCategories;
use common\models\ServicePage;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
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
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchService      = new ServiceSearch();
        $dataProvider       = $searchService->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['published_at' => SORT_DESC]
        ];

        $services = Service::find()
            ->andFilterWhere([
                'domain_id' => Yii::getAlias('@defaultDomainId'),
                'locale'    => 'uk-UA'
            ])
            ->all();

        $list = \yii\helpers\ArrayHelper::map($services, 'locale_group_id', 'title');

        $dataProvider->query->andFilterWhere([ 'locale' => Yii::$app->language]);

        return $this->render('index', [
                'searchModel'  => $searchService,
                'dataProvider' => $dataProvider,
                'list'         => $list
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentService         = Service::getLocaleInstance($key);
            $currentService->locale = $key;

            if (Yii::$app->request->get('scenario')) {
                $currentService->on_scenario = Yii::$app->request->get('scenario');
            }

            $services[$key] = $currentService;
        }

        //set data from default service
        if (Yii::$app->request->get('locale_group_id')) {

            $defaultDomainServices = Service::find()
                ->andFilterWhere([
                    'domain_id'       => Yii::getAlias('@defaultDomainId'),
                    'locale_group_id' => Yii::$app->request->get('locale_group_id')
                ])
                ->all();

            foreach ($defaultDomainServices as $key => $value) {
                if (!in_array(
                        $value->locale, array_keys(
                            Yii::$app->params['availableLocales']
                        )
                    )
                ) {
                    continue;
                };
                $services[$value->locale]->slug        = $value->slug;
                $services[$value->locale]->title       = $value->title;
                $services[$value->locale]->head        = $value->head;
                $services[$value->locale]->body        = $value->body;
                $services[$value->locale]->price       = $value->price;
                $services[$value->locale]->description = $value->description;
                $services[$value->locale]->thumbnail   = $value->thumbnail;
                $services[$value->locale]->before_body = $value->before_body;
                $services[$value->locale]->after_body  = $value->after_body;
            }
        }

        $service = new MultiModel([
            'models' => $services
        ]);

        if ($service->load(Yii::$app->request->post()) && Service::multiSave($service)) {
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
                    'model'      => $service,
                    'categories' => ServiceCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
            ]);
        }
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $firstService = $this->findService($id);

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentService              = Service::getLocaleInstance($key);
            $dataService                 = $currentService::find()
                ->andWhere([
                    'locale_group_id' => $firstService->locale_group_id,
                    'locale'          => $key
                ])
                ->one();
            $dataService->categoriesList = $this->getCategoriesListIds($dataService->id);

            if (!empty($dataService->domain)) {
                $dataService->domain = explode(',', $dataService->domain);
            }

            $services[$key] = $dataService;

            if (!$services[$key]) {
                $currentService->attributes  = $firstService->attributes;
                $currentService->attachments = $firstService->attachments;

                $currentService->thumbnail = $firstService->thumbnail;
                //TODO: thumbnail copy fix

                $currentService->categoriesList  = $firstService->categoriesList;
                //$currentService->video = $firstService->video;
                $currentService->locale_group_id = $firstService->locale_group_id;
                $currentService->locale          = $key;
                $currentService->title           = 'title ' . $key . ' ' . time();
                $currentService->descripton      = $firstService->description;
                $currentService->price           = $firstService->price;
                $currentService->slug            = '';

                $services[$key] = $currentService;
            }
        }

        $service = new MultiModel([
            'models' => $services
        ]);

        if ($service->load(Yii::$app->request->post()) && Service::multiSave($service)) {
            return $this->redirect(['index']);
        } else {
            switch ($firstService->on_scenario) {
                case 'extend' :
                    $viewName = 'extend';
                    break;
                default :
                    $viewName = 'update';
            }

            return $this->render($viewName, [
                    'model'      => $service,
                    'categories' => ServiceCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
            ]);
        }
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findService($id)->delete();

        $servicePageService = ServicePage::find()->andWhere(['service_id' => $id])->one();

        if (null === $servicePageService) {
            $this->findService($id)->delete();
        } else {
            Yii::$app->session->setFlash('alert', [
                'body'    => \Yii::t('backend', 'Can not delete service #' . $id . '. It used in other table. Delete servicePage page #' . $servicePageService->id . ' first.'),
                'options' => ['class' => 'alert-error']
            ]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the service is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findService($id)
    {
        if (($service = Service::findOne($id)) !== null) {
            return $service;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function getCategoriesListIds($id)
    {
        $arr = [];

        $services = ServiceCategories::find()->andWhere(['service_id' => $id])->all();

        foreach ($services as $service) {
            $arr[] = $service->category_id;
        }

        return $arr;
    }
}