<?php

namespace backend\controllers;

use Yii;
use common\models\FinanceCategory;
use backend\models\search\FinanceCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Finance;

/**
 * FinanceCategoryController implements the CRUD actions for FinanceCategory model.
 */
class FinanceCategoryController extends Controller
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
     * Lists all FinanceCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchFinance  = new FinanceCategorySearch();
        $dataProvider = $searchFinance->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel'  => $searchFinance,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FinanceCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                'model' => $this->findFinance($id),
        ]);
    }

    /**
     * Creates a new FinanceCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $finance = new FinanceCategory();

        if ($finance->load(Yii::$app->request->post()) && $finance->save()) {
            return $this->redirect(['view', 'id' => $finance->id]);
        } else {
            return $this->render('create', [
                    'model'      => $finance,
                    'categories' => FinanceCategory::find()->noParents()->all(),
            ]);
        }
    }

    /**
     * Updates an existing FinanceCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $finance = $this->findFinance($id);

        if ($finance->load(Yii::$app->request->post()) && $finance->save()) {
            return $this->redirect(['view', 'id' => $finance->id]);
        } else {
            return $this->render('update', [
                    'model'      => $finance,
                    'categories' => FinanceCategory::find()->noParents()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing FinanceCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $financeFinance = Finance::find()->andWhere(['category_id' => $id])->one();

        if (null === $financeFinance) {
            $this->findFinance($id)->delete();
        } else {
            Yii::$app->session->setFlash('alert', [
                'body'    => \Yii::t('backend', 'Can not delete category #' . $id . '. It used in other table. Change category for finance #' . $financeFinance->id . ' before delete.'),
                'options' => ['class' => 'alert-error']
            ]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the FinanceCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FinanceCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findFinance($id)
    {
        if (($finance = FinanceCategory::findOne($id)) !== null) {
            return $finance;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}