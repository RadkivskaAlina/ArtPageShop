<?php
use yii\widgets\ListView;
$this->title = 'ArtPage';
?>
<section class="section_one">
    <div class="container">
        <div class="section_one__wrapper">
            <div class="section_one__text">
                <div class="section_one__title">
                    <span>Вітаємо вас на нашому сайті!</span>
                </div>
                <div class="section_one__description">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p>
                </div>
                <div class="section_one__submit">
                    <a href="/web/site/about">
                        Більше
                    </a>
                </div>
            </div>
            <div class="section_one__images">
                <div class="section_one__images__second_item">
                    <img src="<?=Yii::$app->request->baseUrl?>/site_images/planner.jpg" alt="" class="section_one__image">
                </div>
                <div class="section_one__images__first_item">
                    <img src="<?=Yii::$app->request->baseUrl?>/site_images/macbook.jpg" alt="">
                    <img src="<?=Yii::$app->request->baseUrl?>/site_images/notebook.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section_two">
    <div class="container">
        <div class="section_two__wrapper">
            <div class="section_two__products">
                <div class="section_two__title">
                    <p>Новинки</p>
                </div>
                <?=ListView::widget([
                    'dataProvider' => $dataProvider,
                    'options' =>[
                        'tag' => 'div',
                        'class' => 'list-wrapper',
                    ],
                    'itemView' => '/product/_item',

                    'layout' => "\n{items}\n{pager}",
                ]);
                ?>
            </div>
            <div class="section_two__categories">
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
            </div>
        </div>
    </div>
</section>