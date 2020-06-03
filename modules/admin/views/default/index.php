<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="admin-default-index">
    <h1>Ласкаво просимо, адміне</h1>
</div>
<div class="link"> 
    <p>Повний список таблиць:</p>
    <?=Html::a('block', Url::to('admin/block'))?><br>
    <?=Html::a('delivery', Url::to('admin/delivery'))?><br>
    <?=Html::a('manufacture', Url::to('admin/manufacture'))?><br>
    <?=Html::a('order', Url::to('admin/order'))?><br>
    <?=Html::a('payment', Url::to('admin/payment'))?><br>
    <?=Html::a('product', Url::to('admin/product'))?><br>
    <?=Html::a('page', Url::to('admin/page'))?><br>
    <?=Html::a('page category', Url::to('admin/page-category'))?><br>
    <?=Html::a('user', Url::to('admin/user'))?><br>
</div>