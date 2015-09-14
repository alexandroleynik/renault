<?php

namespace backend\controllers;

use Yii;
use common\models\Page;
use backend\models\search\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\base\MultiModel;

/**
 * PageController implements the CRUD actions for Page model.
 */
class FixController extends Controller
{

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        die('fix');
    }
}