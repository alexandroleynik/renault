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
        <!--[if gt IE 9]><!-->
        <link rel="stylesheet" media="screen"
              href="/css/small.min.css<?php echo '?v=' . filemtime(Yii::getAlias('@webroot/css/small.min.css')) ?>">
        <link rel="stylesheet" media="screen and (min-width: 36.3125em)"
              href="/css/medium.min.css<?php echo '?v=' . filemtime(Yii::getAlias('@webroot/css/medium.min.css')) ?>">
        <link rel="stylesheet" media="screen and (min-width: 60em)"
              href="/css/large.min.css<?php echo '?v=' . filemtime(Yii::getAlias('@webroot/css/large.min.css')) ?>">
        <!--<![endif]-->

        <!--[if lte IE 9 ]>
           <link rel="stylesheet" href="https://libs.cdn.renault.com/etc/designs/renault_v2/2.3.0-92/common-assets/css/pre-ie10.min.css">
        <![endif]-->

        <link rel="icon" type="image/png" href="/favicon.ico">
        <?php $this->head() ?>
        <?php echo Html::csrfMetaTags() ?>
        <?= Html::cssFile(YII_DEBUG ? '@web/css/all.css?v=' . filemtime(Yii::getAlias('@webroot/css/all.min.css'))
                    : '@web/css/all.min.css?v=' . filemtime(Yii::getAlias('@webroot/css/all.min.css')))
        ?>
        <?= Html::cssFile('@web/plugins/rs-plugin/css/settings.css?v=' . filemtime(Yii::getAlias('@webroot/plugins/rs-plugin/css/settings.css'))) ?>
<?php echo DbText::widget(['key' => 'frontend.code.head.end', 'domain_id' => Yii::getAlias('@domainId')]); ?>
    </head>
    <body>
<?php $this->beginBody() ?>


        <main id="container" role="main">
<?php echo $content ?>
        </main>

<?php require_once '_loader.php'; ?>
        <script>
            console.log('proxy test 1');
        </script>

        <?= Html::jsFile(YII_DEBUG ? '@web/js/build.js?v=' . filemtime(Yii::getAlias('@webroot/js/build.js'))
                    : '@web/js/build.min.js?v=' . filemtime(Yii::getAlias('@webroot/js/build.min.js')))
        ?>
        <script>
            console.log('proxy test 2');
        </script>

        <script src="http://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=uk"></script>

        <script>
            console.log('proxy test 3');
        </script>
<?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>

