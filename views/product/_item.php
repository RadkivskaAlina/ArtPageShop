<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="product">
    <div class="product__image">
        <img src="<?=Yii::$app->request->baseUrl?>/uploads/<?=$model->image?>" alt="">
    </div>
    <div class="product__title">
        <a href="<?=Yii::$app->request->baseUrl?>/product/<?=$model->id?>" class="product__title">
            <?=$model->name?>
        </a>
    </div>
    <div class="product__price">
        <?=$model->price?>грн
    </div>
    <div class="product__submit">
        <?=Html::a('Додати в корзину', Url::to(['cart/add/'.$model->id]))?>
    </div>
</div>
