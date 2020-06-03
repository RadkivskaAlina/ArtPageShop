<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\helpers\StatusHelper;
use app\helpers\OrderHelper;
use app\models\Delivery;
use app\models\Payment;

$delivery = Delivery::findActive();
$payment = Payment::findActive();
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_id')->dropDownList(
        ArrayHelper::map($delivery, 'id', 'name')
    ) ?>

<?= $form->field($model, 'payment_id')->dropDownList(
        ArrayHelper::map($payment, 'id', 'name')
    ) ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'status')->dropdownList(OrderHelper::show()) ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

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
