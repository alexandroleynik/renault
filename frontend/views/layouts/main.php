<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Session;
use yii\web\Response;
use common\widgets\DbText;

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo Html::encode($this->title) ?></title>

<!--	<link rel="stylesheet" media="screen" href="//libs.cdn.renault.com/etc/designs/renault_v2/2.3.0-92/common-assets/css/fonts/fonts-cyrillic.min.css">-->
    <!--<link rel="stylesheet" media="screen"
          href="https://libs.cdn.renault.com/etc/designs/renault/127/common-assets/css/fonts/fonts-latin-basic.min.css">-->
    
    <link rel="stylesheet" media="screen"
          href="/css/small.min.css<?php echo '?v=' . filemtime(Yii::getAlias('@webroot/css/small.min.css')) ?>">
    <link rel="stylesheet" media="screen and (min-width: 36.3125em)"
          href="/css/medium.min.css<?php echo '?v=' . filemtime(Yii::getAlias('@webroot/css/medium.min.css')) ?>">
    <link rel="stylesheet" media="screen and (min-width: 60em)"
          href="/css/large.min.css<?php echo '?v=' . filemtime(Yii::getAlias('@webroot/css/large.min.css')) ?>">
    

    <!--[if lte IE 9 ]>
       <link rel="stylesheet" href="https://libs.cdn.renault.com/etc/designs/renault_v2/2.3.0-92/common-assets/css/pre-ie10.min.css">
    <![endif]-->

    <link rel="icon" type="image/png" href="/favicon.ico">
    <?php $this->head() ?>
    <?php echo Html::csrfMetaTags() ?>
    <?= Html::cssFile(YII_DEBUG ? '@web/css/all.css?v=' . filemtime(Yii::getAlias('@webroot/css/all.min.css')) : '@web/css/all.min.css?v=' . filemtime(Yii::getAlias('@webroot/css/all.min.css'))) ?>
    <?= Html::cssFile('@web/plugins/rs-plugin/css/settings.css?v=' . filemtime(Yii::getAlias('@webroot/plugins/rs-plugin/css/settings.css'))) ?>
    <?php echo DbText::widget(['key' => 'frontend.code.head.end', 'domain_id' => Yii::getAlias('@domainId')]); ?>
    <style>
        .disabled-page {
            position: relative;
            width: 100%;
            height: 100vh;
            min-height: 700px;
            z-index: 100001;
            background: white;
        }

        .disabled-content {
            width: 580px;
            height: 620px;
            text-align: center;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            z-index: 100002
        }

        .disabled-content img {
            margin: 0 auto 50px;
        }

        .disabled-content h2 {
            font-size: 48px;
            line-height: 48px;
            margin-bottom: 18px;
        }

        .disabled-content p {
            font-size: 22px;
            line-height: 30px;
        }

        .disabled-content p a {
            text-decoration: underline;
            color: #ffcf00;
        }

        .disabled-content p a span {
            color: #333;
        }

        @media screen and (max-width: 1919px) {
            .disabled-content img {
                width: 210px;
                margin: 0 auto 53px;
            }

            .disabled-content h2 {
                font-size: 36px;
                line-height: 36px;
                margin-bottom: 18px;
            }

            .disabled-content p {
                font-size: 18px;
                line-height: 24px;
                margin-bottom: 20px;
            }
        }

        @media screen and (max-width: 1023px) {
            .disabled-content img {
                width: 200px;
                margin: 0 auto 60px;
            }

            .disabled-content p {
                font-size: 17px;
                line-height: 20px;
                margin-bottom: 20px;
            }
        }

        @media screen and (max-width: 767px) {
            .disabled-content {
                max-width: 80%;
                height: 420px;
            }

            .disabled-content img {
                width: 144px;
                margin: 0 auto 50px;
            }

            .disabled-content h2 {
                font-size: 22px;
                line-height: 22px;
                margin-bottom: 18px;
            }

            .disabled-content p {
                font-size: 11px;
                line-height: 14px;
                margin-bottom: 20px;
            }
        }
        .preload-mask {
            display: block;
            position: fixed;
            width: 100%;
            width: 100vw;
            height: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            background: white;
            content: "";
            z-index: 99999;
        }

        .preload-logo {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            margin: auto;
            width: 300px;
            height: 130px;
            z-index: 99999;
        }

        .preload-logo div {
            width: 160px;
            margin: 10px auto 0;
        }
    </style>    
</head>
<body>
    <?php $this->beginBody() ?>


    <main id="container" role="main">
        <?php echo $content ?>
    </main>
    
    <?php require_once '_loader.php'; ?>

    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <?= Html::jsFile(YII_DEBUG ? '@web/js/build.js?v=' . filemtime(Yii::getAlias('@webroot/js/build.js')) : '@web/js/build.min.js?v=' . filemtime(Yii::getAlias('@webroot/js/build.min.js'))) ?>
    
    <?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>

