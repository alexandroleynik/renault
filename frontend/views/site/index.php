<?php

use yii\helpers\Url;
use common\models\Page;
use common\widgets\DbText;
use common\components\filesystem\FileLogic;
use yii\helpers\FileHelper;
use backend\modules\i18n\models\search\I18nMessageSearch;
?>

<?php
Page::switchToUrlLocale();
?>

<?php require_once Yii::getAlias('@webroot/templates/noscript.html') ?>
<?php require_once Yii::getAlias('@webroot/templates/app.html') ?>

<?php
$js = 'server_config = ' . json_encode(Yii::$app->keyStorage->getAllArray()) . ';'
    . 'server_config.frontend_app_debug = "' . YII_DEBUG . '";'
    . 'server_config.frontend_app_web_url = "' . Yii::getAlias('@frontendUrl') . Yii::getAlias('@web') . '";'
    . 'server_config.frontend_app_frontend_url = "' . Yii::getAlias('@frontendUrl') . '";'
    . 'server_config.frontend_app_domain_id = "' . Yii::getAlias('@domainId') . '";'
    . 'server_config.frontend_app_default_domain_id = "' . Yii::getAlias('@defaultDomainId') . '";'
    . 'server_config.frontend_app_dealer_id = "' . Yii::getAlias('@dealerId') . '";'
    . 'server_config.frontend_app_locale = "' . Yii::$app->language . '";'
    . 'server_config.frontend_app_facebook_app_id = "' . getenv('FACEBOOK_APP_ID') . '";'
    . 'server_config.frontend_app_instagram_client_id = "' . getenv('INSTAGRAM_CLIENT_ID') . '";'
    . 'server_config.frontend_app_code_body_end = "' . htmlspecialchars(str_replace(array("\r\n", "\r", "\n"), "", DbText::widget(['key' => 'frontend.code.body.end', 'domain_id' => Yii::getAlias('@domainId')]))) . '";'
    . 'server_config.frontend_app_files_midified = ' . json_encode(FileLogic::getModifiedTime(FileHelper::findFiles(Yii::getAlias('@webroot/templates')))) . ';'
    . 'server_config.frontend_app_t = ' . json_encode(I18nMessageSearch::getForFrontend()) . ';'
    . 'server_config.frontend_app_api_url = "' . Yii::getAlias('@apiUrl') . '";';

$this->registerJs($js, \yii\web\View::POS_HEAD);

//yii\helpers\VarDumper::dump(common\models\Page::getMetaTags(), 11, 1); die();

foreach (Page::getMetaTags() as $tag) {
    $this->registerMetaTag($tag);
}
?>
<?php // if (empty($_SESSION['flag'])): ?>
    <?php // $_SESSION['flag'] = true ?>
    <!-- <div id="mobile-popup" class="mobile-greeting hidden-lg hidden"> -->
    <!-- <div id="mobile-popup" class="mobile-greeting">
        <button class="close-btn">✕</button>
        <p>test
            <?php // echo Yii::t('frontend', 'popupMessage'); ?>
        </p>
        <button class="big-close-btn"><?php //echo Yii::t('frontend', 'Close'); ?></button>
    </div> -->
<?php // endif; ?>

<?php
//\frontend\assets\AppAsset::register($this);
?>

<script>
function mobilePopup() {
  var isMobile = false,
      popup, style, text, buttonText;
  if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
      || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
  if(isMobile) {
    console.log(window.app.router.locale);

    // switch(window.cufonSiteLocal) {
    switch(window.app.router.locale) {
      // case 'ru_UA':
      case 'ru':
        text = 'Специально для Вас мы сделали мобильную версию! Попробуйте!';
        buttonText = 'Перейти';
        break;
      // case 'uk_UA':
      case 'ua':
        text = 'Спеціально для Вам ми зробили мобільну версію! Спробуйте!';
        buttonText = 'Перейти';
        break;
      default: break;
    }

    style = '<style>.mobile-greeting {position: fixed;display: block;z-index: 99;background-color: white;top: 0;left: 0;bottom: 0;right: 0;margin: auto;width: 400px;height: 220px;box-shadow: 0px 0px 10px rgba(0, 0, 0, .3);}.mobile-greeting p {font-size: 22px;line-height: 26px;color: #050505;margin-top: 41px;text-align: center;}.mobile-greeting .close-btn {position: absolute;border: none;font-size: 24px;line-height: 18px;color: #666666;background: none;cursor: pointer;top: 10px;right: 10px;padding: 0;margin: 0;}.mobile-greeting .big-close-btn {display: block;margin: 20px auto 0;background: #ffdd33;height: 50px;width: 180px;cursor: pointer;border: none;font-size: 14px;font-weight: 400;}@media screen and (max-width: 420px) {.mobile-greeting {max-width: 90%;height: 250px;}}</style>'
    popup = style + '<div id="mobile-popup" class="mobile-greeting"><button class="close-btn">✕</button><p>' + text + '</p><button class="big-close-btn">' + buttonText + '</button>';
    document.body.append(popup);
  }
}

window.onload = function(){mobilePopup();};
</script>
