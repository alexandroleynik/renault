<?php

namespace backend\controllers;

use Yii;
use common\models\Finance;
use backend\models\search\FinanceSearch;
use \common\models\FinanceCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\base\MultiModel;
use common\models\FinanceCategories;
use common\models\FinancePage;

/**
 * FinanceController implements the CRUD actions for Finance model.
 */
class FinanceController extends Controller
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
     * Lists all Finance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchFinance      = new FinanceSearch();
        $dataProvider       = $searchFinance->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['published_at' => SORT_DESC]
        ];

        $finances = Finance::find()
            ->andFilterWhere([
                'domain_id' => Yii::getAlias('@defaultDomainId'),
                'locale'    => 'uk-UA'
            ])
            ->all();

        $list = \yii\helpers\ArrayHelper::map($finances, 'locale_group_id', 'title');

        $dataProvider->query->andFilterWhere([ 'locale' => Yii::$app->language]);

        return $this->render('index', [
                'searchModel'  => $searchFinance,
                'dataProvider' => $dataProvider,
                'list'         => $list
        ]);
    }

    /**
     * Creates a new Finance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentFinance         = Finance::getLocaleInstance($key);
            $currentFinance->locale = $key;

            if (Yii::$app->request->get('scenario')) {
                $currentFinance->on_scenario = Yii::$app->request->get('scenario');
            }

            $finances[$key] = $currentFinance;
        }

        //set data from default finance
        if (Yii::$app->request->get('locale_group_id')) {

            $defaultDomainFinances = Finance::find()
                ->andFilterWhere([
                    'domain_id'       => Yii::getAlias('@defaultDomainId'),
                    'locale_group_id' => Yii::$app->request->get('locale_group_id')
                ])
                ->all();

            foreach ($defaultDomainFinances as $key => $value) {
                if (!in_array(
                        $value->locale, array_keys(
                            Yii::$app->params['availableLocales']
                        )
                    )
                ) {
                    continue;
                };
                $finances[$value->locale]->slug        = $value->slug;
                $finances[$value->locale]->title       = $value->title;
                $finances[$value->locale]->head        = $value->head;
                $finances[$value->locale]->body        = $value->body;
                $finances[$value->locale]->price       = $value->price;
                $finances[$value->locale]->description = $value->description;
                $finances[$value->locale]->thumbnail   = $value->thumbnail;
                $finances[$value->locale]->before_body = $value->before_body;
                $finances[$value->locale]->after_body  = $value->after_body;
            }
        }

        $finance = new MultiModel([
            'models' => $finances
        ]);

        if ($finance->load(Yii::$app->request->post()) && Finance::multiSave($finance)) {
            return $this->redirect(['index']);
        } else {
            switch (Yii::$app->request->get('scenario')) {
                case 'extend' :
                    $viewName = 'extend';
                    break;
                default :
                    $viewName = 'create';
            }
            return $this->render($viewName, [
                    'model'      => $finance,
                    'categories' => FinanceCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
            ]);
        }
    }

    /**
     * Updates an existing Finance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $firstFinance = $this->findFinance($id);

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentFinance              = Finance::getLocaleInstance($key);
            $dataFinance                 = $currentFinance::find()
                ->andWhere([
                    'locale_group_id' => $firstFinance->locale_group_id,
                    'locale'          => $key
                ])
                ->one();
            $dataFinance->categoriesList = $this->getCategoriesListIds($dataFinance->id);

            if (!empty($dataFinance->domain)) {
                $dataFinance->domain = explode(',', $dataFinance->domain);
            }

            $finances[$key] = $dataFinance;

            if (!$finances[$key]) {
                $currentFinance->attributes  = $firstFinance->attributes;
                $currentFinance->attachments = $firstFinance->attachments;

                $currentFinance->thumbnail = $firstFinance->thumbnail;
                //TODO: thumbnail copy fix

                $currentFinance->categoriesList  = $firstFinance->categoriesList;
                //$currentFinance->video = $firstFinance->video;
                $currentFinance->locale_group_id = $firstFinance->locale_group_id;
                $currentFinance->locale          = $key;
                $currentFinance->title           = 'title ' . $key . ' ' . time();
                $currentFinance->descripton      = $firstFinance->description;
                $currentFinance->price           = $firstFinance->price;
                $currentFinance->slug            = '';

                $finances[$key] = $currentFinance;
            }
        }

        $finance = new MultiModel([
            'models' => $finances
        ]);

        if ($finance->load(Yii::$app->request->post()) && Finance::multiSave($finance)) {
            return $this->redirect(['index']);
        } else {
            switch ($firstFinance->on_scenario) {
                case 'extend' :
                    $viewName = 'extend';
                    break;
                default :
                    $viewName = 'update';
            }

            return $this->render($viewName, [
                    'model'      => $finance,
                    'categories' => FinanceCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
            ]);
        }
    }

    /**
     * Deletes an existing Finance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findFinance($id)->delete();

        $financePageFinance = FinancePage::find()->andWhere(['finance_id' => $id])->one();

        if (null === $financePageFinance) {
            $this->findFinance($id)->delete();
        } else {
            Yii::$app->session->setFlash('alert', [
                'body'    => \Yii::t('backend', 'Can not delete finance #' . $id . '. It used in other table. Delete financePage page #' . $financePageFinance->id . ' first.'),
                'options' => ['class' => 'alert-error']
            ]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Finance model based on its primary key value.
     * If the finance is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Finance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findFinance($id)
    {
        if (($finance = Finance::findOne($id)) !== null) {
            return $finance;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function getCategoriesListIds($id)
    {
        $arr = [];

        $finances = FinanceCategories::find()->andWhere(['finance_id' => $id])->all();

        foreach ($finances as $finance) {
            $arr[] = $finance->category_id;
        }

        return $arr;
    }
}