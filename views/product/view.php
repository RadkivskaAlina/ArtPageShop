<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->params['breadcrumbs'][] = [
    'url' => Url::to(['/product-category/'.$model->category->id]),
    'label' => $model->category->name,
];
$this->params['breadcrumbs'][] = ['label' => $model->name];
?>
<div class="container products__wrapper">
    <section class="section_product">
        <div class="product_wrapper">
            <div class="section_product__image">
                <img src="<?=Yii::$app->request->baseUrl?>/uploads/<?=$model->image?>" alt="">
                <div class="section_one__submit">
                    <a href="<?=Yii::$app->request->baseUrl?>/cart/add/<?=$model->id?>">Додати в корзину</a>
                </div>
            </div>
            <div class="section_product__text">
                <h2>
                    <?=$model->name?>
                </h2>
                <p>
                    Категорія: <?=$model->category->name?>
                </p>
                <p>
                    <?=$model->content?>
                </p>
                <p>
                    Ціна: <?=$model->price?>грн
                </p>
                <p>
                    Виробництво: <?=$model->manufacture->name?>
                </p>
            </div>
        </div>
        <div class="news__wrapper">
            <p>Новинки</p>

            <?php
            echo ListView::widget([
                'dataProvider' => $data_provider,
                'options' =>[
                    'tag' => 'div',
                    'class' => 'list-wrapper',
                ],
                'itemView' => '/product/_item',

                'layout' => "\n{items}\n{pager}"
            ])
            ?>
        </div>
    </section>
    <section class="section_two__categories">
        <div class="section_two__categories__title">
            <p>Категорії</p>
        </div>
        <div class="section_two__categories__list">
            <ul>
                <?php if(is_array($categories)):?>
                <?php foreach($categories as $category):?>
                    <li><a href="/web/product-category/<?= $category->id?>"><?= $category->name?></a></li>
                <?php endforeach;?>
                <?php endif;?>
            </ul>
        </div>
    </section>
</div>