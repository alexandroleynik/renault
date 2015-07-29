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

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo Html::encode($this->title) ?></title>

	<link rel="stylesheet" media="screen" href="//libs.cdn.renault.com/etc/designs/renault_v2/69/common-assets/css/fonts/fonts-cyrillic.min.css">
    <!--<link rel="stylesheet" media="screen"
          href="https://libs.cdn.renault.com/etc/designs/renault/127/common-assets/css/fonts/fonts-latin-basic.min.css">-->
    <!--[if gt IE 9]><!-->
    <link rel="stylesheet" media="screen"
          href="https://libs.cdn.renault.com/etc/designs/renault/127/common-assets/css/small.min.css">
    <link rel="stylesheet" media="screen and (min-width: 36.3125em)"
          href="https://libs.cdn.renault.com/etc/designs/renault/127/common-assets/css/medium.min.css">
    <link rel="stylesheet" media="screen and (min-width: 60em)"
          href="https://libs.cdn.renault.com/etc/designs/renault/127/common-assets/css/large.min.css">
    <!--<![endif]-->

    <!--[if lte IE 9 ]>
       <link rel="stylesheet" href="https://libs.cdn.renault.com/etc/designs/renault/127/common-assets/css/pre-ie10.min.css">
    <![endif]-->

    <link rel="icon" type="image/png" href="/favicon.ico">
    <?php $this->head() ?>
    <?php echo Html::csrfMetaTags() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <?php require_once '_header.php'; ?>

    <main id="container" role="main">
        <?php echo $content ?>
    </main>

    <?php require_once '_footer.php'; ?>

    <?php require_once '_loader.php'; ?>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
