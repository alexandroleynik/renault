<?php

namespace backend\controllers;

use Yii;
use common\models\Info;
use backend\models\search\InfoSearch;
use \common\models\InfoCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\base\MultiModel;
use common\models\InfoCategories;

/**
 * InfoController implements the CRUD actions for Info model.
 */
class InfoController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ]
            ]
        ];
    }

    /**
     * Lists all Info models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel        = new InfoSearch();
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['published_at' => SORT_DESC]
        ];

        $dataProvider->query->andFilterWhere([ 'locale' => Yii::$app->language]);

        $models = Info::find()
            ->andFilterWhere([
                'domain_id' => Yii::getAlias('@defaultDomainId'),
                'locale'    => 'uk-UA'
            ])
            ->all();

        $list = \yii\helpers\ArrayHelper::map($models, 'locale_group_id', 'title');


        return $this->render('index', [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
                'list'         => $list
        ]);
    }

    /**
     * Creates a new Info model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentModel         = Info::getLocaleInstance($key);
            $currentModel->locale = $key;
            //$currentModel->title  = 'title ' . $key . ' ' . time();
            $models[$key]         = $currentModel;
        }

        //set data from default model
        if (Yii::$app->request->get('locale_group_id')) {

            $defaultDomainModels = Info::find()
                ->andFilterWhere([
                    'domain_id'       => Yii::getAlias('@defaultDomainId'),
                    'locale_group_id' => Yii::$app->request->get('locale_group_id')
                ])
                ->all();

            foreach ($defaultDomainModels as $key => $value) {
                $models[$value->locale]->slug  = $value->slug;
                $models[$value->locale]->title = $value->title;
                $models[$value->locale]->head  = $value->head;
                $models[$value->locale]->body  = $value->body;
                $models[$value->locale]->description  = $value->description;
            }
        }

        $model = new MultiModel([
            'models' => $models
        ]);

        if ($model->load(Yii::$app->request->post()) && Info::multiSave($model)) {
            return $this->redirect(['index', 'mid' => $model->getModel(Yii::$app->language)->model_id]);
        } else {
            //print_r(array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls'))));
            //die()
            return $this->render('create', [
                    'model'      => $model,
                    'categories' => InfoCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
            ]);
        }
    }

    /**
     * Updates an existing Info model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $firstModel = $this->findModel($id);

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentModel              = Info::getLocaleInstance($key);
            $dataModel                 = $currentModel::find()
                ->andWhere([
                    'locale_group_id' => $firstModel->locale_group_id,
                    'locale'          => $key
                ])
                ->one();
            $dataModel->categoriesList = $this->getCategoriesListIds($dataModel->id);

            if (!empty($dataModel->domain)) {
                $dataModel->domain = explode(',', $dataModel->domain);
            }

            $models[$key] = $dataModel;

            if (!$models[$key]) {
                $currentModel->attributes      = $firstModel->attributes;
                $currentModel->attachments     = $firstModel->attachments;
                $currentModel->thumbnail       = $firstModel->thumbnail;
                $currentModel->categoriesList  = $firstModel->categoriesList;
                //$currentModel->video = $firstModel->video;
                $currentModel->locale_group_id = $firstModel->locale_group_id;
                $currentModel->locale          = $key;
                $currentModel->title           = 'title ' . $key . ' ' . time();
                $currentModel->descripton      = $firstModel->description;
                $currentModel->model_id        = $firstModel->model_id;
                $currentModel->slug            = '';

                $models[$key] = $currentModel;
            }
        }

        $model = new MultiModel([
            'models' => $models
        ]);

        if ($model->load(Yii::$app->request->post()) && Info::multiSave($model)) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                    'model'      => $model,
                    'categories' => InfoCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
            ]);
        }
    }

    /**
     * Deletes an existing Info model.
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
     * Finds the Info model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Info the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Info::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function getCategoriesListIds($id)
    {
        $arr = [];

        $models = InfoCategories::find()->andWhere(['info_id' => $id])->all();

        foreach ($models as $model) {
            $arr[] = $model->category_id;
        }

        return $arr;
    }
}