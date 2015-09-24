<?php

use yii\helpers\Url;
use common\models\Page;
use common\widgets\DbText;
?>

<?php
Page::switchToUrlLocale();
?>

<?php require_once Yii::getAlias('@webroot/js/app/templates/app.html') ?>

<?php
$js = 'app.config = ' . json_encode(Yii::$app->keyStorage->getAllArray()) . ';'
    . 'app.config.frontend_app_debug = "' . YII_DEBUG . '";'
    . 'app.config.frontend_app_web_url = "' . Yii::getAlias('@web') . '";'
    . 'app.config.frontend_app_frontend_url = "' . Yii::getAlias('@frontendUrl') . '";'
    . 'app.config.frontend_app_domain_id = "' . Yii::getAlias('@domainId') . '";'
    . 'app.config.frontend_app_default_domain_id = "' . Yii::getAlias('@defaultDomainId') . '";'
    . 'app.config.frontend_app_dealer_id = "' . Yii::getAlias('@dealerId') . '";'
    . 'app.config.frontend_app_locale = "' . Yii::$app->language . '";'    
    . 'app.config.frontend_app_facebook_app_id = "' . getenv('FACEBOOK_APP_ID') . '";'
    . 'app.config.frontend_app_instagram_client_id = "' . getenv('INSTAGRAM_CLIENT_ID') . '";'
    . 'app.config.frontend_app_code_body_end = "' . htmlspecialchars(str_replace(array("\r\n", "\r", "\n"), "", DbText::widget(['key' => 'frontend.code.body.end']))) . '";'
    . 'app.config.frontend_app_api_url = "' . Yii::getAlias('@apiUrl') . '";';

$this->registerJs($js, \yii\web\View::POS_END);

//yii\helpers\VarDumper::dump(common\models\Page::getMetaTags(), 11, 1); die();

foreach (Page::getMetaTags() as $tag) {
    $this->registerMetaTag($tag);
}?>
<?php if(empty($_SESSION['flag'])): ?>
<?php $_SESSION['flag'] = true ?>
    <div id="mobile-popup" class="mobile-greeting hidden-lg">
        <button class="close-btn">✕</button>
        <p>
            <?php echo Yii::t('frontend', 'popupMessage'); ?>
        </p>
        <button class="big-close-btn"><?php echo Yii::t('frontend', 'Close') ;?></button>
    </div>
<?php endif; ?>

<?php
//\frontend\assets\AppAsset::register($this);
?>

