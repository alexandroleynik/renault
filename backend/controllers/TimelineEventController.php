<?php

namespace backend\controllers;

use Yii;
use backend\models\search\TimelineEventSearch;
use yii\web\Controller;
use common\models\TimelineEvent;

/**
 * Application timeline controller
 */
class TimelineEventController extends Controller
{
    public $layout = 'common';

    /**
     * Lists all TimelineEvent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel        = new TimelineEventSearch();
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC]
        ];

        return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRollBack($id)
    {
        $model      = $this->findModel($id);
        $table      = (new $model->category)->tableName();
        $attributes = $model['data']['attributes'];

        try {
            $update = Yii::$app->db->createCommand()->update($table, $attributes, ['id' => $attributes['id']])->execute();

            if (!$update) {
                $insert = Yii::$app->db->createCommand()->insert($table, $attributes)->execute();
            }
        } catch (\yii\db\Exception $exc) {
            
        }

        if ($exc->getMessage()) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-error'],
                'body'    => $exc->getMessage()
            ]);
        } else {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body'    => Yii::t('backend', 'Updated') . ':' . $update . Yii::t('backend', 'Inserted') . ':' . $insert
            ]);
        }

        $this->redirect('index');
    }

    protected function findModel($id)
    {
        if (($model = TimelineEvent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested data does not exist.');
        }
    }
}