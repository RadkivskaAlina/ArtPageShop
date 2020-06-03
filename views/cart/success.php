<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Cart;

$this->title = 'Замовлення оформлено';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="section_two__title">
        <p><?=$this->title;?></p>
    </div>
    <div class="cart_description">
        <span>
            Дякуємо за покупку.
        </span><br>
        <span>
            Номер вашого замовлення <?=$id?>.
        </span><br>
    </div>
</div>
