<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://libs.cdn.renault.com/etc/designs/renault/127/common-assets/css/fonts/fonts-latin-basic.min.css',
        "https://libs.cdn.renault.com/etc/designs/renault/127/common-assets/css/small.min.css",
        "https://libs.cdn.renault.com/etc/designs/renault/127/common-assets/css/medium.min.css",
        "https://libs.cdn.renault.com/etc/designs/renault/127/common-assets/css/large.min.css",
        'css/style.css',
    ];

    public $depends = [
        //'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'common\assets\Html5shiv',
    ];
}
