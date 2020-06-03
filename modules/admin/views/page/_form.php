<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\helpers\StatusHelper;
use app\models\PageCategory;

$category = PageCategory::showActive();
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'short_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(StatusHelper::show()) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map($category, 'id', 'name')
    ) ?>

    <?= $form->field($model, 'image')->fileInput()?>
    <?php if(!empty($model->image)): ?>
        <img src="<?=Yii::$app->request->baseUrl?>/uploads/<?=$model->image?>" alt="" style="height: 100px">
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
