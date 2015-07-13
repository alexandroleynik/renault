<?php

use common\widgets\DbText;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

$shortLocale = explode('-', Yii::$app->language)[0];
?>

<footer itemscope itemtype="http://schema.org/WPFooter" class="grid-row bleed">
    <nav class="c_032">
        <div class="grid-row">
            <div class="col-12">


                <dl class="col-3">
                    <dt>
                        <a href="index.html#" class="accordionToggle">
                            <span><?= Yii::t('frontend', 'Toggle Buying a Renault menu') ?></span>
                        </a>
                        <span><?= Yii::t('frontend', 'RENAULT В УКРАЇНІ') ?></span>
                    </dt>


                    <dd><a href="<?= Url::to('/' . $shortLocale . '/page/view/find-a-dealer'); ?>"><?= Yii::t('frontend', 'Find a dialer') ?></a>
                    </dd>


                    <dd><a href="<?= Url::to('/' . $shortLocale . '/page/view/book-a-test-drive'); ?>"><?= Yii::t('frontend', 'Записатися на тест-драйв') ?></a>
                    </dd>


                    <dd><a href="<?= Url::to('/' . $shortLocale . '/page/view/news'); ?>"><?= Yii::t('frontend', 'News') ?></a>
                    </dd>

                    <dd><a href="<?= Url::to('/' . $shortLocale . '/page/view/promos'); ?>"><?= Yii::t('frontend', 'Promos') ?></a>
                    </dd>


                    <dd><a href="#"><?= Yii::t('frontend', 'Підписатись на новини') ?></a>
                    </dd>


                </dl>


                <dl class="col-3 last">
                    <dt>
                        <a href="index.html#" class="accordionToggle">
                            <span><?= Yii::t('frontend', 'Toggle Renault Social menu') ?></span>
                        </a>
                        <span><?= Yii::t('frontend', 'RENAULT В СОЦІАЛЬНИХ МЕРЕЖАХ') ?></span>
                    </dt>


                    <dd><a class="social-icon icon-facebook" href="https://www.facebook.com/renault.ua" target="_blank"
                           rel="">
                            <span><?= Yii::t('frontend', 'facebook') ?></span>
                        </a>
                    </dd>


                    <dd><a class="social-icon icon-twitter" href="https://twitter.com/renaultukraine" target="_blank"
                           rel="">
                            <span><?= Yii::t('frontend', 'twitter') ?></span>
                        </a>
                    </dd>


                    <!--<dd><a class="social-icon icon-youtube" href="https://vk.com/renaultukraine" target="_blank" rel="">
                           <span>youtube</span>
                        </a>
                    </dd>-->


                    <dd><a class="social-icon icon-googleplus" href="https://plus.google.com/+renaultua/posts"
                           target="_blank" rel="publisher">
                            <span><?= Yii::t('frontend', 'google') ?></span>
                        </a>
                    </dd>


                </dl>


                <dl class="col-6">
                    <dt>
                        <a href="index.html#" class="accordionToggle">
                            <span><?= Yii::t('frontend', 'Toggle More from Renault menu') ?></span>
                        </a>
                        <span><?= Yii::t('frontend', 'КОНТАКТНА ІНФОРМАЦІЯ') ?></span>
                    </dt>


                    <dd>
                        <p><?= Yii::t('frontend', 'Компания «Рено Украина» официальное представительство Renault S.A.S. в Украине находится в г.
                            Киев') ?></p>

                        <p><?= Yii::t('frontend', 'По вопросам приобретения автомобилей на специальных условиях обращайтесь в отдел
                            корпоративных продаж:') ?>
                        </p>

                        <p><?= Yii::t('frontend', 'Тел: ') ?>
                            <b><?= Yii::t('frontend', '+38 (044) 490 6832') ?></b> <?= Yii::t('frontend', '(доб. 7017)') ?>
                            <br>
                            <?= Yii::t('frontend', 'e-mail:') ?>
                            <b><?= Yii::t('frontend', 'fleet.ua@renault.com') ?></b></p>
                    </dd>

                </dl>


            </div>
        </div>
    </nav>
</footer>


<footer class="grid-row bleed">
    <nav class="c_025">

        <p class="strapline"><?= Yii::t('frontend', 'PASSION FOR LIFE') ?></p>

        <div class="grid-row">
            <div class="col-12">


                <ul class="footer-options">
                    <li><a href="#" title=""></a></li>
                </ul>

                <div class="footer-legal">


                    <ul>


                        <li><a href="legal.html" title=""><?= Yii::t('frontend', 'Юридична інформація') ?></a></li>


                    </ul>

                    <p class="footer-copyright"><?= Yii::t('frontend', '&copy; 2015 Renault UA') ?></p>
                </div>
            </div>
        </div>
    </nav>
</footer>

