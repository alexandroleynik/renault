<?php

namespace backend\controllers;

use common\components\keyStorage\FormModel;
use Yii;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest ? 'base' : 'common';
        return parent::beforeAction($action);
    }

    public function actionSettings()
    {
        $model = new FormModel([
            'keys' => [
                /* 'frontend.maintenance' => [
                  'label' => Yii::t('backend', 'Frontend maintenance mode'),
                  'type' => FormModel::TYPE_DROPDOWN,
                  'items' => [
                  0 => Yii::t('backend', 'Disabled'),
                  1 => Yii::t('backend', 'Enabled')
                  ]
                  ], */
                'backend_theme_skin'               => [
                    'label' => Yii::t('backend', 'Backend theme'),
                    'type'  => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'skin-black'  => 'skin-black',
                        'skin-blue'   => 'skin-blue',
                        'skin-green'  => 'skin-green',
                        'skin-purple' => 'skin-purple',
                        'skin-red'    => 'skin-red',
                        'skin-yellow' => 'skin-yellow'
                    ]
                ],
                'backend_layout_fixed'             => [
                    'label' => Yii::t('backend', 'Fixed backend layout'),
                    'type'  => FormModel::TYPE_CHECKBOX
                ],
                'backend_layout_boxed'             => [
                    'label' => Yii::t('backend', 'Boxed backend layout'),
                    'type'  => FormModel::TYPE_CHECKBOX
                ],
                'backend_layout_collapsed_sidebar' => [
                    'label' => Yii::t('backend', 'Backend sidebar collapsed'),
                    'type'  => FormModel::TYPE_CHECKBOX
                ]
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body'    => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success']
            ]);
            return $this->refresh();
        }

        return $this->render('settings', ['model' => $model]);
    }

    public function actionRedir($path)
    {
        $url = Yii::getAlias('@frontendUrl') . '/' . $path;

        $this->redirect($url);
    }

    public function actionWidgets()
    {
        //if file_get_contant works
        /*
          $filename = Yii::getAlias('@apiUrl/file/schema/view?id=page-body&language=' . Yii::$app->language . '&domain_id=' . \Yii::$app->user->identity->domain_id);
          $content  = file_get_contents($filename);
          $items    = json_decode($content);
         */

        //if curl works
        /* $filename    = Yii::getAlias('@apiUrl/file/schema/view?id=page-body&language=' . Yii::$app->language . '&domain_id=' . \Yii::$app->user->identity->domain_id);
          $curl_handle = curl_init();
          curl_setopt($curl_handle, CURLOPT_URL, $filename);
          curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
          curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
          $content     = curl_exec($curl_handle);
          curl_close($curl_handle);
          $items       = json_decode($content);         
         */

        $base = new \api\models\schema\base\RootBase();

        $items  = $base->getData()['items']['oneOf'];
        $models = [];
        foreach ($items as $key => $value) {
            preg_match('/___(.+)___/', $value['properties']['tab_title']['watch']['title'], $matches);
            $id = $matches[1];

            $models[] = [
                'id'    => $id,
                'title' => $value['title']
            ];
        }

        return $this->render('widgets', ['models' => $models]);
    }
}