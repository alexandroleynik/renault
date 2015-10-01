<?php

namespace api\controllers\file;

use Yii;
use api\models\Schema;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;

/**
 * Class SchemaController
 * @author Eugene Fabrikov <eugene.fabrikov@gmail.com>
 */
class SchemaController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'api\models\Schema';

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
     * @param $id
     * @return json
     * @throws HttpException
     */
    public function findModel($id)
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $model = Schema::find($id);

        if (!$model) {
            throw new HttpException(404);
        }
        
        return $model;
    }
}