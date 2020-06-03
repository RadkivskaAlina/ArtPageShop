<?php
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

$manufacture_list = ArrayHelper::map($manufacture, 'id', 'name');
?>
<div class="container">
    <?php $this->params['breadcrumbs'][] = ['label' => $model->name];?>
    <section class="section_search">
        <?php
            Pjax::begin();
            $form = ActiveForm::begin([
                'action' => ['/product-category/'.$model->id],
                'method' => 'get',
                'options' => [
                    'data-piax' => 1,
                ],
            ])
        ?>
        <div class="search__wrapper">
            <div class="search__manufacture col-md-4">
                <?= $form->field($searchModel, 'manufacture_id')->checkboxList($manufacture_list)?>
            </div>
            <div class="search__price">
                <div class="col-md-4">
                    <?= $form->field($searchModel, 'minprice')?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($searchModel, 'maxprice')?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($searchModel, 'sort_option')->dropDownList([
                        'asc' => 'Зростаючи',
                        'desc' => 'Спадаючи'    
                    ])?>
                </div>
            </div>
            <div class="section_one__submit">
                <?=  Html::submitButton('Шукати')?>
            </div>
        </div>
    </section>
    <section class="section_categories">
        <div class="section_two__wrapper">
            <div class="categories__products" style="width: 100%">
                <div class="section_two__title">
                    <p><?=$model->name?></p>
                </div>
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options' => [
                            'tag' => 'div',
                            'class' => 'list-wrapper',
                        ],
                        'itemView' => '/product/_item',

                        'layout' => "\n{items}\n{pager}",
                    ])
                    ?>
                <?php ActiveForm::end()?>
                <?php Pjax::end()?>
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
    </section>
</div>