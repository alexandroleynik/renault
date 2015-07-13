<?php

use yii\helpers\Url;
use common\models\Page;

$shortLocale = explode('-',Yii::$app->language)[0];
?>
    <div class="header">


        <ul id="skiplinks" class="skiplinks">
            <li>
                <a href="<?= Url::to('/#container'); ?>">Skip to Main Content</a>
                </li>
        </ul>


        <div itemscope="itemscope" itemtype="http://schema.org/WPHeader">
            <header class="c_010 grid-row bleed">
                <div class="col-12">

                    <div class="global-nav-container" role="navigation" aria-label="global navigation">
                        <ul class="nav-global grid-row">
                            <li class="login">


                                <div class="top__lang animated fadeInDownBig">
                                    <ul class="list-unstyled">
                                        <li class = "<?= ('ru-RU' == Yii::$app->language)? 'current':''; ?>"><a href="<?= Url::to(['/site/set-locale','locale'=>'ru-RU']); ?>" class = "lang-item"><?= Yii::t('frontend','Rus'); ?></a></li>
                                        <li class = "<?= ('uk-UA' == Yii::$app->language)? 'current':''; ?>"><a href="<?= Url::to(['/site/set-locale','locale'=>'uk-UA']); ?>" class = "lang-item"><?= Yii::t('frontend','Ukr'); ?></a></li>
                                    </ul>
                                </div><!--.top__lang-->


<!--                                <a class="logged-in-state see-profile" href="login-registration.html"-->
<!--                                   data-adobe-tagging="my-account">-->
<!--                                    <img src="etc/designs/renault/127/common-assets/img/avatar/avatar.png">-->
<!--                                    <span></span>-->
<!--                                </a>-->


<!--                                <a class="logged-in-state logout" data-adobe-tagging="" href="index.html">-->
<!--                                    Log out-->
<!--                                </a>-->


                            </li>

                            <li>
                            <li><a href="<?= Url::to('/' . $shortLocale . '/page/view/dealers_nearby'); ?>" class = "ajaxLink"><?= Yii::t('frontend','Dealers nearby') ?></a></li>
                                <a href="find-a-dealer.html">
                                    Дилери поруч
                                </a>
                            </li>
                            <li>
                                <a href="discover-renault.html">
                                    Новини
                                </a>
                            </li>
                            <li>
                                <a href="http://my.renault.ua/">
                                    My Renault
                                </a>
                            </li>

                            <li>
                                <a href="http://dealers.renault.ua/ru/site/news">
                                    ПІДПИСКА НА НОВИНИ
                                </a>
                            </li>

                        </ul>
                    </div>


                    <div class="nav-root upgraded">
                        <div class="title-logo-container grid-row">
                            <a class="show-menu" href="index.html#">
                                <span class="is-visually-hidden">Menu</span>
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

                                    <a href="index.html" data-adobe-tagging="Homepage">


                                        <img class="logo-large"
                                             src="https://www.cdn.renault.com/content/dam/Renault/master/new-logo/renault_english_logo_desktop.png"
                                             alt="Renault Logo"/>
                                        <img class="logo-small"
                                             src="https://www.cdn.renault.com/content/dam/Renault/master/new-logo/renault_mobile_logo.png"
                                             alt="Renault Logo"/>


                                    </a>
                                </span>


                            <h1 class="page-title">
                                renault в україні
                            </h1>

                        </div>

                        <div class="nav-container grid-row">
                            <div class="nav-inner">
                                <button class="close-menu" href="#">
                                    <span class="is-visually-hidden">Hide menu</span>
                                </button>


                                <nav aria-label="main navigation" class="grid-row">
                                    <div class="pageNavigation primaryNav">

                                        <ul class=nav-primary itemscope itemtype="http://schema.org/SiteNavigationElement">


                                            <li>
                                                <a class="dropdown" href="index.html#" title="Vehicles">
                                                    МОДЕЛЬНИЙ РЯД
                                                </a>


                                                <div style="" class="expand-container">
                                                    <div class="expand grid-row">
                                                        <div class="sub-nav">
                                                            <ul>


                                                                <li><a href="vehicles/new-vehicles.html"
                                                                       data-adobe-tagging="vehicles|new-vehicles">
                                                                        New&#x20;Vehicles
                                                                    </a>
                                                                </li>


                                                                <li><a href="vehicles/offers.html"
                                                                       data-adobe-tagging="vehicles|offers">
                                                                        Latest&#x20;offers
                                                                    </a>
                                                                </li>


                                                                <li><a href="http://www.renaultsport.co.uk"
                                                                       data-adobe-tagging="">
                                                                        Renaultsport
                                                                    </a>
                                                                </li>


                                                                <li><a href="vehicles/motability.html"
                                                                       data-adobe-tagging="vehicles|motability">
                                                                        Motability
                                                                    </a>
                                                                </li>


                                                                <li>
                                                                    <a href="https://www.renault.co.uk/vehicles/used-vehicles.html"
                                                                       data-adobe-tagging="vehicles|used-vehicles">
                                                                        Used&#x20;Vehicles
                                                                    </a>
                                                                </li>


                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>


                                            <li>
                                                <a itemprop="url" href="services.html" title="Services"
                                                   data-adobe-tagging="services">
                                                    сервіс та запчастини
                                                </a>

                                            </li>


                                            <li>
                                                <a itemprop="url" href="discover-renault.html" title="Discover&#x20;Renault"
                                                   data-adobe-tagging="discover-renault">
                                                    RENAULT FINANCE
                                                </a>

                                            </li>


                                        </ul>


                                    </div>

                                </nav>

                                <ul class="nav-global-small">

                                    <li>
                                        <a href="find-a-dealer.html" data-adobe-tagging="find-a-dealer">
                                            Find a dealer
                                        </a>
                                    </li>
                                    <li>
                                        <a href="contact.html" data-adobe-tagging="contact">
                                            Contact us
                                        </a>
                                    </li>
                                    <li>
                                        <a href="book-a-test-drive.html" data-adobe-tagging="book-a-test-drive">
                                            Book a test drive
                                        </a>
                                    </li>


                                    <li class="login">


                                        <a class="not-logged-in-state" href="login-signup.html" data-adobe-tagging="">
                                            My Renault
                                        </a>


                                        <a class="logged-in-state see-profile" href="login-registration.html"
                                           data-adobe-tagging="my-account">
                                            <img src="etc/designs/renault/127/common-assets/img/avatar/avatar.png">
                                            <span></span>
                                        </a>


                                        <a class="logged-in-state logout" data-adobe-tagging="" href="index.html">
                                            Log out
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
                            <button type="button" class="c_095A-live-chat">Chat with us</button>
                        </script>
                    </div>


                </div>

            </header>
        </div>
    </div>
