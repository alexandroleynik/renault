<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace common\widgets\jsoneditor\assets;

use yii\web\AssetBundle;

class CKFinderAsset extends AssetBundle
{
    public $baseUrl = '@backendUrl/thirdparty/ckfinder';

    public $js = [        
        'ckfinder.js',
        //'ckeditor.sample.init.js',


    ];
    public $css = [
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'        
    ];

}