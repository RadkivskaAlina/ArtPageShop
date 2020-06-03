<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\helpers\StatusHelper;
use app\models\ProductCategory;
use app\models\Manufacture;

$category = ProductCategory::showActive();
$manufacture = Manufacture::showActive();
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'short_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'in_stock')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map($category, 'id', 'name')
    ) ?>

    <?= $form->field($model, 'manufacture_id')->dropDownList(
        ArrayHelper::map($manufacture, 'id', 'name')
    ) ?>

    <?= $form->field($model, 'status')->dropDownList(StatusHelper::show()) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput()?>
    <?php if(!empty($model->image)): ?>
        <img src="<?=Yii::$app->request->baseUrl?>/uploads/<?=$model->image?>" alt="" style="height: 100px">
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
