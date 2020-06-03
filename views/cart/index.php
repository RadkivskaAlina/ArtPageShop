<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Cart;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <?php if(is_array($products)):?>
        <div class="section_two__title">
            <p><?=$this->title;?></p>
        </div>
        <?php $cartSum = 0;?>
        <div class="cart__wrapper">
            <div class="cart__titles">
                <div class="cart__title">
                    <h4>Зображення</h4>
                </div>
                <div class="cart__title">
                    <h4>Найменування</h4>
                </div>
                <div class="cart__title">
                    <h4>Ціна</h4>
                </div>
                <div class="cart__title">
                    <h4>Кількість</h4>
                </div>
                <div class="cart__title">
                    <h4>Сума</h4>
                </div>
                <div class="cart__title">
                </div>
            </div>
            <?php foreach($products as $product):?>
                <div class="cart__products">
                    <div class="cart__product cart__product__img">
                        <img src="<?=Yii::$app->request->baseUrl?>/uploads/<?=$product->image?>" alt="">
                    </div>
                    <div class="cart__product">
                        <?= $product->name?>
                    </div>
                    <div class="cart__product">
                        <?= $product->price?>грн
                    </div>
                    <div class="cart__product product__submit">
                        <?= Html::a('+', Url::to(['/cart/add/'.$product->id]))?>
                        <p> </p><?= $productsCart[$product->id];?><p> </p>
                        <?= Html::a('-', Url::to(['/cart/min/'.$product->id]))?>
                    </div>
                    <div class="cart__product">
                        <?=$productsCart[$product->id]*$product->price;?>грн
                        <?php $cartSum += $productsCart[$product->id]*$product->price;?>
                    </div>
                    <div class="cart__product product__submit">
                        <?= Html::a('видалити', Url::to(['/cart/remove/'.$product->id]))?>
                    </div>
                </div>
            <?php endforeach;?>
            <div class="cart__sum">
                До сплати: <?=$cartSum?>грн 
            </div>
        </div>
        <div class="cart__submits__wrapper">
            <div class="section_one__submit">
                <?=Html::a('Очистити корзину', Url::to(['/cart/clear']))?>
            </div>
            <div class="section_one__submit">
                <?=Html::a('Замовити', Url::to(['/cart/checkout']))?>
            </div>
        </div>
        <?php else:?>
            <h3>
                Корзина пуста
            </h3>
    <?php endif;?>
</div>
