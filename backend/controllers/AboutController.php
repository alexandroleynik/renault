<?php

namespace backend\controllers;

use Yii;
use common\models\About;
use backend\models\search\AboutSearch;
use \common\models\AboutCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\base\MultiModel;
use common\models\AboutCategories;
use common\models\AboutPage;

/**
 * AboutController implements the CRUD actions for About model.
 */
class AboutController extends Controller
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
     * Lists all About models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchAbout        = new AboutSearch();
        $searchModel->detachBehaviors();
        $dataProvider       = $searchAbout->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['published_at' => SORT_DESC]
        ];

        $abouts = About::find()
            ->andFilterWhere([
                'domain_id' => Yii::getAlias('@defaultDomainId'),
                'locale'    => 'uk-UA'
            ])
            ->all();

        $list = \yii\helpers\ArrayHelper::map($abouts, 'locale_group_id', 'title');

        $dataProvider->query->andFilterWhere([ 'locale' => Yii::$app->language]);

        return $this->render('index', [
                'searchModel'  => $searchAbout,
                'dataProvider' => $dataProvider,
                'list'         => $list
        ]);
    }

    /**
     * Creates a new About model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentAbout         = About::getLocaleInstance($key);
            $currentAbout->locale = $key;

            if (Yii::$app->request->get('scenario')) {
                $currentAbout->on_scenario = Yii::$app->request->get('scenario');
            }

            $abouts[$key] = $currentAbout;
        }

        //set data from default about
        if (Yii::$app->request->get('locale_group_id')) {

            $defaultDomainAbouts = About::find()
                ->andFilterWhere([
                    'domain_id'       => Yii::getAlias('@defaultDomainId'),
                    'locale_group_id' => Yii::$app->request->get('locale_group_id')
                ])
                ->all();

            foreach ($defaultDomainAbouts as $key => $value) {
                if (!in_array(
                        $value->locale, array_keys(
                            Yii::$app->params['availableLocales']
                        )
                    )
                ) {
                    continue;
                };
                $abouts[$value->locale]->slug        = $value->slug;
                $abouts[$value->locale]->title       = $value->title;
                $abouts[$value->locale]->head        = $value->head;
                $abouts[$value->locale]->body        = $value->body;
                $abouts[$value->locale]->price       = $value->price;
                $abouts[$value->locale]->description = $value->description;
                $abouts[$value->locale]->thumbnail   = $value->thumbnail;
                $abouts[$value->locale]->before_body = $value->before_body;
                $abouts[$value->locale]->after_body  = $value->after_body;
            }
        }

        $about = new MultiModel([
            'models' => $abouts
        ]);

        if ($about->load(Yii::$app->request->post()) && About::multiSave($about)) {
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
                    'model'      => $about,
                    'categories' => AboutCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
            ]);
        }
    }

    /**
     * Updates an existing About model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $firstAbout = $this->findAbout($id);

        foreach (Yii::$app->params['availableLocales'] as $key => $value) {
            $currentAbout              = About::getLocaleInstance($key);
            $dataAbout                 = $currentAbout::find()
                ->andWhere([
                    'locale_group_id' => $firstAbout->locale_group_id,
                    'locale'          => $key
                ])
                ->one();
            $dataAbout->categoriesList = $this->getCategoriesListIds($dataAbout->id);

            if (!empty($dataAbout->domain)) {
                $dataAbout->domain = explode(',', $dataAbout->domain);
            }

            $abouts[$key] = $dataAbout;

            if (!$abouts[$key]) {
                $currentAbout->attributes  = $firstAbout->attributes;
                $currentAbout->attachments = $firstAbout->attachments;

                $currentAbout->thumbnail = $firstAbout->thumbnail;
                //TODO: thumbnail copy fix

                $currentAbout->categoriesList  = $firstAbout->categoriesList;
                //$currentAbout->video = $firstAbout->video;
                $currentAbout->locale_group_id = $firstAbout->locale_group_id;
                $currentAbout->locale          = $key;
                $currentAbout->title           = 'title ' . $key . ' ' . time();
                $currentAbout->descripton      = $firstAbout->description;
                $currentAbout->price           = $firstAbout->price;
                $currentAbout->slug            = '';

                $abouts[$key] = $currentAbout;
            }
        }

        $about = new MultiModel([
            'models' => $abouts
        ]);

        if ($about->load(Yii::$app->request->post()) && About::multiSave($about)) {
            return $this->redirect(['index']);
        } else {
            switch ($firstAbout->on_scenario) {
                case 'extend' :
                    $viewName = 'extend';
                    break;
                default :
                    $viewName = 'update';
            }

            return $this->render($viewName, [
                    'model'      => $about,
                    'categories' => AboutCategory::find()->active()->all(),
                    'domains'    => array_combine(explode(',', Yii::getAlias('@frontendUrls')), explode(',', Yii::getAlias('@frontendUrls')))
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
        //$this->findAbout($id)->delete();

        $aboutPageAbout = AboutPage::find()->andWhere(['about_id' => $id])->one();

        if (null === $aboutPageAbout) {
            $this->findAbout($id)->delete();
        } else {
            Yii::$app->session->setFlash('alert', [
                'body'    => \Yii::t('backend', 'Can not delete about #' . $id . '. It used in other table. Delete aboutPage page #' . $aboutPageAbout->id . ' first.'),
                'options' => ['class' => 'alert-error']
            ]);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the About model based on its primary key value.
     * If the about is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return About the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findAbout($id)
    {
        if (($about = About::findOne($id)) !== null) {
            return $about;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function getCategoriesListIds($id)
    {
        $arr = [];

        $abouts = AboutCategories::find()->andWhere(['about_id' => $id])->all();

        foreach ($abouts as $about) {
            $arr[] = $about->category_id;
        }

        return $arr;
    }
}