<?php

namespace api\controllers\db;

use Yii;
use api\models\FinanceCategory;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;

/**
 * Class FinanceCategoryController
 * @author Eugene Terentev <eugene@terentev.net>
 */
class FinanceCategoryController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'api\models\FinanceCategory';

    /**
     * @var array
     */
    public $serializer = [
        'class'              => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index'   => [
                'class'               => 'yii\rest\IndexAction',
                'modelClass'          => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider']
            ],
            'view'    => [
                'class'      => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'findModel'  => [$this, 'findModel']
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction'
            ]
        ];
    }

    /**
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        $ignore = Yii::$app->request->get('ignore', 0);
         $where = Yii::$app->request->get('where', []);

        return new ActiveDataProvider(array(
            'query' => FinanceCategory::find()
                ->active()
                ->ignore($ignore)
                ->andFilterWhere($where)
        ));
    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws HttpException
     */
    public function findModel($id)
    {
        $model = FinanceCategory::find()
            ->active()
            ->andWhere(['id' => (int) $id])
            ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }
}