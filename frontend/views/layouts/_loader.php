<?php $arr = Yii::$app->request->pathInfo;
$slug = explode('/', $arr);

$key = explode(',', Yii::$app->keyStorage->get('frontend_page_without_header_footer'));


if (isset($slug[1])&&in_array($slug[1], $key)) {
    $loader_ = true;
} else {
    $loader_ = false;
}?>
<!--<div class="preload-mask" style="display: --><?//= !$loader_?'block':'none'; ?><!--">-->
<!--    <div class="preload-logo">-->
<!--        <img src="/img/renault_main_logo.png" alt=""/>-->
<!--        <div id="loaderImage"></div>-->
<!--    </div>-->
<!--</div>-->