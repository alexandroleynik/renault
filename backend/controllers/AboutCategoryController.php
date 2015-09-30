<?php

namespace backend\controllers;

use Yii;
use common\models\AboutCategory;
use backend\models\search\AboutCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\About;

/**
 * AboutCategoryController implements the CRUD actions for AboutCategory model.
 */
class AboutCategoryController extends Controller
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
     * Lists all AboutCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchAbout  = new AboutCategorySearch();
        $dataProvider = $searchAbout->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel'  => $searchAbout,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AboutCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                'model' => $this->findAbout($id),
        ]);
    }

    /**
     * Creates a new AboutCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $about = new AboutCategory();

        if ($about->load(Yii::$app->request->post()) && $about->save()) {
            return $this->redirect(['view', 'id' => $about->id]);
        } else {
            return $this->render('create', [
                    'model'      => $about,
                    'categories' => AboutCategory::find()->noParents()->all(),
            ]);
        }
    }

    /**
     * Updates an existing AboutCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $about = $this->findAbout($id);

        if ($about->load(Yii::$app->request->post()) && $about->save()) {
            return $this->redirect(['view', 'id' => $about->id]);
        } else {
            return $this->render('update', [
                    'model'      => $about,
                    'categories' => AboutCategory::find()->noParents()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing AboutCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $aboutAbout = About::find()->andWhere(['category_id' => $id])->one();

        if (null === $aboutAbout) {
            $this->findAbout($id)->delete();
        } else {
            Yii::$app->session->setFlash('alert', [
                'body'    => \Yii::t('backend', 'Can not delete category #' . $id . '. It used in other table. Change category for about #' . $aboutAbout->id . ' before delete.'),
                'options' => ['class' => 'alert-error']
            ]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the AboutCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AboutCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findAbout($id)
    {
        if (($about = AboutCategory::findOne($id)) !== null) {
            return $about;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}