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
        $updated    = 0;
        $inserted   = 0;

        try {
            $query  = new \yii\db\Query;
            $oldRow = $query
                ->from($table)
                ->andWhere(['id' => $attributes['id']])
                ->one();

            if ($oldRow) {
                $updated = Yii::$app->db->createCommand()->update($table, $attributes, ['id' => $attributes['id']])->execute();
            }

            if (!$oldRow) {
                $inserted = Yii::$app->db->createCommand()->insert($table, $attributes)->execute();
            }
        } catch (\yii\db\Exception $exc) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-error'],
                'body'    => Yii::t('backend', 'Can\'t roll back. ') . $exc->getMessage()
            ]);
        }

        if (empty($exc)) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body'    => Yii::t('backend', 'Updated: {u}. Inserted: {i}.', [
                    'u' => $updated,
                    'i' => $inserted
                ])
            ]);
        }

        TimelineEvent::log(
            $model->category, 'afterRollBack', [
            'attributes' => $attributes,
            'uid'        => Yii::$app->user->identity->id,
            ]
        );

        $redirectUrlParams = ['index'];

        if (Yii::$app->request->get('TimelineEventSearch')) {
            $redirectUrlParams['TimelineEventSearch'] = Yii::$app->request->get('TimelineEventSearch');
        }

        $this->redirect($redirectUrlParams);
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