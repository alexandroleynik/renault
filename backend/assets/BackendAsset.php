<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets;

use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $basePath = '/';
    public $baseUrl = '@backendUrl';

    public $css = [
        'css/style.css'
    ];
    public $js = [
        'js/app.js',
        'js/json-editor/jsoneditor.js',
        'js/jquery.synctranslit.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'common\assets\AdminLte',
        'common\assets\Html5shiv',
         'backend\assets\Select2Asset',
    ];
}
