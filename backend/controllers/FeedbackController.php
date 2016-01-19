<?php

namespace backend\controllers;

use Yii;
use common\models\Feedback;
use backend\models\search\FeedbackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\base\MultiModel;

/**
 * AboutController implements the CRUD actions for About model.
 */
class FeedbackController extends Controller
{

//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class'   => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['post']
//                ]
//            ]
//        ];
//    }

    /**
     * Lists all About models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchFeedback        = new FeedbackSearch();
        $dataProvider       = $searchFeedback->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC]
        ];

//        $feedbacks = Feedback::find()
//            ->andFilterWhere([
//                'domain_id' => \Yii::$app->user->identity->id,
//            ])
//            ->all();





        return $this->render('index', [
                'searchModel'  => $searchFeedback,
                'dataProvider' => $dataProvider,


        ]);
    }

    /**
     * Creates a new About model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Feedback();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);

        } else {
            return $this->render('create', [
                'model' => $model,

            ]);
        }


    }

    public function actionView($id)
    {
//die();
        $model = $this->findModel($id);
//        \yii\helpers\VarDumper::dump($model , 11, true);
        if (!$model) {
            throw new NotFoundHttpException;
        }
        $user = \api\models\User::findOne($model->domain_id);
        $user = $user ? $user->username : '';


        return $this->render('view', ['model'=>$model, 'user'=>$user]);
    }
    /**
     * Updates an existing About model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing About model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {


        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }




    protected function findModel($id)
    {
        if (($model = Feedback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}