<?php

namespace api\controllers\db;

use Yii;
use api\models\Corporate;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;

/**
 * Class BlockController 
 */
class CorporateController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'api\models\Corporate';

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
            'update'  => [
                'class'      => 'yii\rest\UpdateAction',
                'modelClass' => $this->modelClass,
                'findModel'  => [$this, 'findModel']
            ],
            'create'  => [
                'class'      => 'yii\rest\CreateAction',
                'modelClass' => $this->modelClass,
                'findModel'  => [$this, 'findModel'],

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
        $where          = Yii::$app->request->get('where', []);
        $whereOperatorFormat = Yii::$app->request->get('where_operator_format', []);
        
        return new ActiveDataProvider(array(
            'query'      => Corporate::find()

        ));
    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws HttpException
     */
    public function findModel($id)
    {
        $model = Corporate::find()

            ->andWhere(['id' => (int) $id])
            ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }
}