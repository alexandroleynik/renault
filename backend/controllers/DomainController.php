<?php

namespace backend\controllers;

use Yii;
use common\models\Domain;
use backend\models\search\DomainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Intervention\Image\ImageManagerStatic;

/**
 * DomainController implements the CRUD actions for Domain model.
 */
class DomainController extends Controller
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
    public function actions()
    {
        return [
            'logo-upload' => [
                'class'        => UploadAction::className(),
                'deleteRoute'  => 'logo-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img  = ImageManagerStatic::make($file->read())->fit(284, 90);
                    $file->put($img->encode());
                }
            ],
            'logo-delete' => [
                'class' => DeleteAction::className()
            ],

            'm_logo-upload' => [
                'class'        => UploadAction::className(),
                'deleteRoute'  => 'm_logo-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img  = ImageManagerStatic::make($file->read())->fit(110, 70);
                    $file->put($img->encode());
                }
            ],
            'm_logo-delete' => [
                'class' => DeleteAction::className()
            ]
        ];
    }

    /**
     * Lists all Domain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new DomainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Domain model.
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
     * Creates a new Domain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Domain();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                    'model'       => $model,
                    'dealerItems' => $this->getDealerItems()
            ]);
        }
    }

    /**
     * Updates an existing Domain model.
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
                    'model'       => $model,
                    'dealerItems' => $this->getDealerItems()
            ]);
        }
    }

    /**
     * Deletes an existing Domain model.
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
     * Finds the Domain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Domain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Domain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function getDealerItems()
    {
        $filename = 'http://dealers.renault.ua/platformAjaxRequest.php?controller=dealer&action=index';
        $dealers  = json_decode(file_get_contents($filename));

        $dealerItems = \yii\helpers\ArrayHelper::map(
                $dealers, 'dealers_id', 'dealers_name_ru'
        );        

        return $dealerItems;
    }
}