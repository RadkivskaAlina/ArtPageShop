<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Cart;
use app\models\Block;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
     <?php
    NavBar::begin([]);
    NavBar::end();
    ?> 
<div class="page_wrapper">
    <header class="header">
        <div class="container">
            <div class="wrapper">
                <div class="header__logo">
                    <a href="/web/site">
                        <img src="<?=Yii::$app->request->baseUrl?>/site_images/logo.png" alt="" class="header__image">
                        <span class="logo__title">ArtPage</span>
                    </a>
                </div>
                <div class="header__menu">
                    <div class="header__menu__item">
                        <a href="/web/site/about" class="link">
                            <span>Про нас</span>
                        </a>
                    </div>
                    <div class="header__menu__item">
                        <div class="cart">
                            <a href="/web/cart" class="link">
                                <span>Корзина</span>
                                <?php
                                    echo '<span class="cart__icon">'.Cart::countProducts().'</span>';
                                ?>
                            </a>
                        </div>
                    </div>
                    <div class="header__menu__item">
                            <?php if(Yii::$app->user->isGuest):?>
                                <a href="<?= Url::toRoute(['auth/login'])?>" class="link"><span>Увійти</span></a>
                            <?php else: ?>
                                <?= Html::beginForm(['/auth/logout'], 'post')?>
                                    <input type="submit"class=" btn logout btn-link link" value="Вийти (<?= Yii::$app->user->identity->name?>)">
                                <?= Html::endForm() ?>
                            <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'На головну', 'url' => '/'],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])?>
        </div>
        <?= Alert::widget() ?>
        <?= $content ?>  
    </main>

    <footer class="footer" id="footer">
        <div class="container">
            <div class="footer__wrapper">
                <div class="footer__item">
                    <div class="footer__text">
                        <p>
                            Є питання? Напишіть нам!
                        </p>
                        <div class="footer__text_a">
                            <a href="mailto:<?=Block::getValue('email')?>"><?=Block::getValue('email')?></a>
                        </div>
                        <div class="footer__text_a">
                            <p><?=Block::getValue('phone')?></p>
                        </div>
                    </div>
                    <div class="footer__logo">
                        <div class="header_logo">
                            <img src="<?=Yii::$app->request->baseUrl?>/site_images/logo.png" alt="" class="header__image">
                            <span class="logo__title">ArtPage</span>
                        </div>
                        <p>
                            Created by @Alivka 2019-2020
                        </p>
                    </div>
                    <div class="footer__icons">
                    <a href="<?=Block::getValue('instagram')?>">
                        <img src="<?=Yii::$app->request->baseUrl?>/site_images/instagram.png" alt="">
                    </a>
                    <a href="<?=Block::getValue('facebook')?>">
                        <img src="<?=Yii::$app->request->baseUrl?>/site_images/facebook.png" alt="">
                    </a>
                    <a href="<?=Block::getValue('you_tube')?>">
                            <img src="<?=Yii::$app->request->baseUrl?>/site_images/you_tube.png" alt="">
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
