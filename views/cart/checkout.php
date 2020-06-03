<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Замовлення';
$this->params['breadcrumbs'][] = ['label' => 'Cart', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $first_name = '';
        $second_name = '';
        $phone = '';
        $email = '';

        if(isset(Yii::$app->user->identity)){
            $first_name = Yii::$app->user->identity->first_name;
            $second_name = Yii::$app->user->identity->second_name;
            $phone = Yii::$app->user->identity->phone;
            $email = Yii::$app->user->identity->email;
        }
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'value' => $first_name]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true, 'value' => $second_name]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'value' => $phone]) ?>

    <?= $form->field($model, 'email')->textInput(['rows' => 6, 'value' => $email]) ?>

    <?= $form->field($model, 'delivery_id')->radioList(
        ArrayHelper::map($delivery_list, 'id', 'name')
    ) ?>

    <?= $form->field($model, 'payment_id')->radioList(
        ArrayHelper::map($payment_list, 'id', 'name')
    ) ?>

    <div class="form-group section_one__submit">
        <?= Html::submitButton('Готово') ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>