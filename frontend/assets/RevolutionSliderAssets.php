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
class RevolutionSliderAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/js/lib/rs-plugin';
    public $css = [        
        'css/settings.css',
    ];

    public $js = [
        'js/jquery.themepunch.tools.min.js',
        'js/jquery.themepunch.revolution.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
