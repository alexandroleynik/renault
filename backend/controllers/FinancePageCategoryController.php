<?php

namespace backend\controllers;

use Yii;
use common\models\FinancePageCategory;
use backend\models\search\FinancePageCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\FinancePage;

/**
 * FinancePageCategoryController implements the CRUD actions for FinancePageCategory model.
 */
class FinancePageCategoryController extends Controller
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
     * Lists all FinancePageCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new FinancePageCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FinancePageCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FinancePageCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FinancePageCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                    'model'      => $model,
                    'categories' => FinancePageCategory::find()->noParents()->all(),
            ]);
        }
    }

    /**
     * Updates an existing FinancePageCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                    'model'      => $model,
                    'categories' => FinancePageCategory::find()->noParents()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing FinancePageCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $financePageModel = FinancePage::find()->andWhere(['category_id' => $id])->one();

        if (null === $financePageModel) {
            $this->findModel($id)->delete();
        } else {
            Yii::$app->session->setFlash('alert', [
                'body'    => \Yii::t('backend', 'Can not delete category #' . $id . '. It used in other table. Change category for financePage #' . $financePageModel->id . ' before delete.'),
                'options' => ['class' => 'alert-error']
            ]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the FinancePageCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FinancePageCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FinancePageCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}