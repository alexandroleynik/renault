<?php

namespace backend\controllers;

use Yii;
use common\models\ServiceCategory;
use backend\models\search\ServiceCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Service;

/**
 * ServiceCategoryController implements the CRUD actions for ServiceCategory model.
 */
class ServiceCategoryController extends Controller
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
     * Lists all ServiceCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchService  = new ServiceCategorySearch();
        $dataProvider = $searchService->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel'  => $searchService,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                'model' => $this->findService($id),
        ]);
    }

    /**
     * Creates a new ServiceCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $service = new ServiceCategory();

        if ($service->load(Yii::$app->request->post()) && $service->save()) {
            return $this->redirect(['view', 'id' => $service->id]);
        } else {
            return $this->render('create', [
                    'model'      => $service,
                    'categories' => ServiceCategory::find()->noParents()->all(),
            ]);
        }
    }

    /**
     * Updates an existing ServiceCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $service = $this->findService($id);

        if ($service->load(Yii::$app->request->post()) && $service->save()) {
            return $this->redirect(['view', 'id' => $service->id]);
        } else {
            return $this->render('update', [
                    'model'      => $service,
                    'categories' => ServiceCategory::find()->noParents()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing ServiceCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $serviceService = Service::find()->andWhere(['category_id' => $id])->one();

        if (null === $serviceService) {
            $this->findService($id)->delete();
        } else {
            Yii::$app->session->setFlash('alert', [
                'body'    => \Yii::t('backend', 'Can not delete category #' . $id . '. It used in other table. Change category for service #' . $serviceService->id . ' before delete.'),
                'options' => ['class' => 'alert-error']
            ]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiceCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findService($id)
    {
        if (($service = ServiceCategory::findOne($id)) !== null) {
            return $service;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}