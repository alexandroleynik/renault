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
class CommonAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';    

    public $js       = [
        /*'js/lib/jquery-ui.min.js',
        'js/lib/jquery.bxslider.min.js',
        'js/lib/preload.js',
        'js/lib/isotope.pkgd.min.js',
        'js/lib/imagesloaded.pkgd.min.js',
        'https://maps.googleapis.com/maps/api/js?v=3.exp',
        'js/lib/owl.carousel.min.js',
        'js/lib/facebook.sdk.js',
        'js/lib/twitter.widget.js',
        'http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js',
        'https://maps.googleapis.com/maps/api/js?v=3.exp',        
        'js/lib/jquery.html5Loader.min.js',
        'js/lib/preload.js',
        'bootstrap/js/bootstrap.min.js',
        'js/lib/wow.min.js',
        'js/lib/jquery.nav.js',
        'js/lib/jquery.flexslider-min.js',
        'js/lib/jquery.bxslider.min.js', #old widget
        'js/lib/jquery.validate.min.js',
        'js/lib/additional-methods.min.js',
        'js/lib/design.js',
        'js/lib/facebook.sdk.js',
        'js/lib/twitter.widget.js',
        'js/lib/isotope.pkgd.min.js',*/
        
        'js/lib/jquery-ui.min.js',        
        'js/lib/isotope.pkgd.min.js',
        'https://maps.googleapis.com/maps/api/js?v=3.exp',        
        'js/lib/facebook.sdk.js',
        'js/lib/jquery.cycle2.carousel.min.js',
        'js/lib/jquery.cycle2.min.js',
        'js/lib/jquery.cycle2.scrollVert.min.js',
        'js/lib/jquery.flexslider-min.js',
        'js/lib/jquery.formstyler.min.js',
        

        'js/lib/design.js',
        'js/common.js'
    ];
    public $depends = [
        'frontend\assets\FrontendAsset',
        'yii\web\JqueryAsset'
    ];

}