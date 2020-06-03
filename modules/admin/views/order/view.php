<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Checkout */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="checkout-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'surname',
            'phone',
            'email:email',
            'delivery_id',
            'payment_id',
            'sum',
            'count',
            'status',
            'date_create',
            'date_update',
        ],
    ]) ?>
    <?php if(is_array($products)):?>
        <h4>Products:</h4>
        <?php $cartSum = 0;?>
        <?php foreach($products as $product):?>
            <div class="row">
                <div class="col-md-3">
                    <?= $product->name?>
                </div>
                <div class="col-md-3">
                    <?= $product->price?>
                </div>
                <div class="col-md-1">
                    <?= $productsCart[$product->id];?>
                </div>
                <div class="col-md-1">
                    <?=$productsCart[$product->id]*$product->price;?>грн
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
    <h4>Сума: <?=$model->sum?></h4>

</div>
