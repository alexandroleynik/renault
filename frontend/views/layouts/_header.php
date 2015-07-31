<?php

use yii\helpers\Url;
use common\models\Page;

$shortLocale = explode('-', Yii::$app->language)[0];
?>
<div class="header">


    <ul id="skiplinks" class="skiplinks">
        <li>
            <a href="<?= Url::to('/#container'); ?>"><?= Yii::t('frontend', 'Skip to Main Content') ?></a>
        </li>
    </ul>


    <div itemscope="itemscope" itemtype="http://schema.org/WPHeader">
        <header class="c_010 grid-row bleed">
            <div class="col-12">

                <div class="global-nav-container" role="navigation" aria-label="global navigation">
                    <ul class="nav-global grid-row">
                        <li>
                            <a href="<?= Url::to('http://my.renault.ua/'); ?>" target="_blank" rel="external">
                                <?= Yii::t('frontend', 'My Renault') ?>
                            </a>
                        </li>


                        <li class="lang-choose">
                                <ul class="list-unstyled">
                                    <li class="<?= ('ru-RU' !== Yii::$app->language) ? 'current' : ''; ?>" style="display:none;"><a
                                            href="#"
                                            class="lang-item" short-lang ="ru" ><?= Yii::t('frontend', 'Rus'); ?></a></li>
                                    <li class="<?= ('uk-UA' !== Yii::$app->language) ? 'current' : ''; ?>" style="display:none;"><a
                                            href="#"
                                            class="lang-item" short-lang ="uk" ><?= Yii::t('frontend', 'Ukr'); ?></a></li>
                                    <style>
                                        li.current{
                                            display: block !important;
                                        }
                                    </style>
                                </ul>
                        </li>

                    </ul>
                </div>


                <div class="nav-root upgraded">
                    <div class="title-logo-container grid-row">
                        <a class="show-menu" href="javascript:void(0);">
                            <span class="is-visually-hidden"><?= Yii::t('frontend', 'Menu') ?></span>
                        </a>

                                <span class="logo">
                                    <script type="application/ld+json">
                                        {   "@context" : "http://schema.org",
                                        "@type" : "Organization",
                                        "name" : "Renault",
                                        "url" : "http://www.renault.co.uk",
                                        "logo" : "http://www.cdn.renault.com/content/dam/Renault/master/new-logo/renault_english_logo_desktop.png"
                                        }




                                    </script>

                                    <a href="<?= Url::to('/' . $shortLocale . '/home'); ?>"
                                       data-adobe-tagging="Homepage" class="ajaxLink">


                                        <img class="logo-large"
                                             src="https://www.cdn.renault.com/content/dam/Renault/master/new-logo/renault_english_logo_desktop.png"
                                             alt="Renault Logo"/>
                                        <img class="logo-small"
                                             src="https://www.cdn.renault.com/content/dam/Renault/master/new-logo/renault_mobile_logo.png"
                                             alt="Renault Logo"/>


                                    </a>
                                </span>


                        <a href="<?= Url::to('/' . $shortLocale . '/home'); ?>"><h1 class="page-title">
                            <!--                            renault в україні-->
                            <?= Yii::t('frontend', 'renault in Ukraine') ?>

                        </h1></a>

                    </div>

                    <div class="nav-container grid-row">
                        <div class="nav-inner">
                            <button class="close-menu" href="#">
                                <span class="is-visually-hidden"><?= Yii::t('frontend', 'Hide menu') ?></span>
                            </button>


                            <nav aria-label="main navigation" class="grid-row">
                                <div class="pageNavigation primaryNav">

                                    <ul class=nav-primary itemscope itemtype="http://schema.org/SiteNavigationElement">
                                        <li class="visible-mobile"><a href="<?= Url::to('/' . $shortLocale . '/home'); ?>"
                                               class="ajaxLink"><?= Yii::t('frontend', 'Home') ?>
                                                <!--                                                Дилери поруч-->
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown ajaxLink"
                                               href="<?= Url::to('/' . $shortLocale . '/models'); ?>"
                                               title="Vehicles">
                                                <!--                                                МОДЕЛЬНИЙ РЯД-->
                                                <?= Yii::t('frontend', 'RANGE') ?>

                                            </a>


                                            <div style="" class="expand-container">
                                                <div class="expand grid-row">
                                                    <div class="sub-nav">
                                                        <ul>


                                                            <li><a href="#"
                                                                   data-adobe-tagging="vehicles|new-vehicles">
                                                                    <?= Yii::t('frontend', 'New&#x20;Vehicles') ?>

                                                                </a>
                                                            </li>


                                                            <li><a href="#"
                                                                   data-adobe-tagging="vehicles|offers">
                                                                    <?= Yii::t('frontend', 'Latest&#x20;offers') ?>

                                                                </a>
                                                            </li>


                                                            <li><a href="#"
                                                                   data-adobe-tagging="">
                                                                    <?= Yii::t('frontend', 'Renaultsport') ?>

                                                                </a>
                                                            </li>


                                                            <li><a href="#"
                                                                   data-adobe-tagging="vehicles|motability">
                                                                    <?= Yii::t('frontend', 'Motability') ?>

                                                                </a>
                                                            </li>


                                                            <li>
                                                                <a href="#"
                                                                   data-adobe-tagging="vehicles|used-vehicles">
                                                                    <?= Yii::t('frontend', 'Used&#x20;Vehicles') ?>

                                                                </a>
                                                            </li>


                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li><a href="<?= Url::to('/' . $shortLocale . '/find-a-dealer'); ?>"
                                               class="ajaxLink"><?= Yii::t('frontend', 'Dealers nearby') ?>
                                                <!--                                                Дилери поруч-->
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?= Url::to('/' . $shortLocale . '/news'); ?>"
                                               class="ajaxLink">
                                                <?= Yii::t('frontend', 'News') ?>
                                                <!--                                                Новини-->
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::to('/' . $shortLocale . '/promos'); ?>"
                                               class="ajaxLink">
                                                <?= Yii::t('frontend', 'Promotions') ?>
                                                <!--                                                Акції-->
                                            </a>
                                        </li>
                                    </ul>


                                </div>

                            </nav>

                            <ul class="nav-global-small">

                                <!--<li>
                                    <a href=""<?= Url::to('/' . $shortLocale . '/find-a-dialer'); ?>"" data-adobe-tagging="find-a-dealer" class="ajaxLink">
                                        <?= Yii::t('frontend', 'Find a dealer') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-adobe-tagging="contact" class="ajaxLink">
                                        <?= Yii::t('frontend', 'Contact us') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to('/' . $shortLocale . '/book-a-test-drive'); ?>" data-adobe-tagging="book-a-test-drive" class="ajaxLink">
                                        <?= Yii::t('frontend', 'Book a test drive') ?>
                                    </a>
                                </li>-->

                                <li>
                                    <a href="#">
                                        <?= Yii::t('frontend', 'subscribes') ?>
                                        <!--                                        ПІДПИСКА НА НОВИНИ-->
                                    </a>
                                </li>


                                <li class="login">


                                    <a class="not-logged-in-state" href="#" data-adobe-tagging="" class="ajaxLink">
                                        <?= Yii::t('frontend', 'My Renault') ?>
                                    </a>


                                    <a class="logged-in-state see-profile" href="#" class="ajaxLink"
                                       data-adobe-tagging="my-account">
                                        <img src="#">
                                        <span></span>
                                    </a>


                                    <a class="logged-in-state logout" data-adobe-tagging="" href="index.html">
                                        <?= Yii::t('frontend', 'Log out') ?>
                                    </a>


                                </li>

                            </ul>

                        </div>
                    </div>


                </div>
                <div class="nav-mask"></div>
            </div>
            <div class="liveChatScript title">


                <div class="c_095A"
                     data-script-url="https://c.la2w1.salesforceliveagent.com/content/g/js/32.0/deployment.js"
                     data-live-chat-init-url="https://d.la2w1.salesforceliveagent.com/chat"
                     data-live-chat-init-param1="572b0000000TYQt"
                     data-live-chat-init-param2="00Db0000000cZvn"
                     data-live-chat-button-id="573b0000000TYSB"
                     data-live-chat-custom-detail="&#x7b;&#x7d;"
                    >
                    <script data-component="c_095A" type="text/x-handlebars-template">
                        <button type="button"
                                class="c_095A-live-chat"><?= Yii::t('frontend', 'Chat with us') ?></button>
                    </script>
                </div>


            </div>

        </header>
    </div>
</div>
