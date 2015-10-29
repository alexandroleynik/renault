<?php

namespace backend\controllers;

use backend\models\search\WidgetTextSearch;
use Yii;
use common\models\WidgetText;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WidgetTextController implements the CRUD actions for WidgetText model.
 */
class WidgetTextController extends Controller
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
     * Lists all WidgetText models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->addThirdPartyRows();

        $searchModel  = new WidgetTextSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new WidgetText model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WidgetText();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing WidgetText model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->addRobotsRows();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing WidgetText model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('edit/edit', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WidgetText model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WidgetText model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WidgetText the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WidgetText::findOne(['id' => $id, 'domain_id' => \Yii::$app->user->identity->domain_id]))
            !== null) {
            return $model;
        } else {
            if (($model = WidgetText::findOne(['key' => $id, 'domain_id' => \Yii::$app->user->identity->domain_id]))
                !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
    }

    private function addThirdPartyRows()
    {
        $this->processThirdPartyRow('frontend.code.head.end', 'Код в конце head');
        $this->processThirdPartyRow('frontend.code.body.end', 'Код в конце body');
    }

    private function processThirdPartyRow($key, $title)
    {
        $model = WidgetText::findOne([
                'key'       => $key,
                'domain_id' => \Yii::$app->user->identity->domain_id]
        );

        if (empty($model)) {
            $this->saveThirdPartyRow($key, $title);
        }
    }

    private function saveThirdPartyRow($key, $title)
    {
        $model            = new WidgetText();
        $model->key       = $key;
        $model->title     = $title;
        $model->domain_id = \Yii::$app->user->identity->domain_id;
        $model->status = 1;
        $model->save();
    }

    private function addRobotsRows()
    {
        $this->processRobotsRow('frontend.web.robots.txt', 'Robots.txt');
    }

    private function processRobotsRow($key, $title)
    {
        $model = WidgetText::findOne([
                'key'       => $key,
                'domain_id' => \Yii::$app->user->identity->domain_id]
        );

        if (empty($model)) {
            $this->saveRobotsRow($key, $title);
        }
    }

    private function saveRobotsRow($key, $title)
    {
        $model            = new WidgetText();
        $model->key       = $key;
        $model->title     = $title;
        $model->domain_id = \Yii::$app->user->identity->domain_id;
        $model->body      = 'User-agent: * ' . PHP_EOL . 'Disallow:/';
        $model->status = 1;
        $model->save();
    }
}