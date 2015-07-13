<?php

namespace backend\controllers;

use Yii;
use common\models\PromoCategory;
use backend\models\search\PromoCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Promo;

/**
 * PromoCategoryController implements the CRUD actions for PromoCategory model.
 */
class PromoCategoryController extends Controller
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
     * Lists all PromoCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new PromoCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PromoCategory model.
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
     * Creates a new PromoCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PromoCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                    'model'      => $model,
                    'categories' => PromoCategory::find()->noParents()->all(),
            ]);
        }
    }

    /**
     * Updates an existing PromoCategory model.
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
                    'categories' => PromoCategory::find()->noParents()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing PromoCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $promoModel = Promo::find()->andWhere(['category_id' => $id])->one();

        if (null === $promoModel) {
            $this->findModel($id)->delete();
        } else {
            Yii::$app->session->setFlash('alert', [
                'body'    => \Yii::t('backend', 'Can not delete category #' . $id . '. It used in other table. Change category for promo #' . $promoModel->id . ' before delete.'),
                'options' => ['class' => 'alert-error']
            ]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the PromoCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PromoCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PromoCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}