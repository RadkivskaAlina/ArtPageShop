<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="page">
    <div class="page__image">
        <img src="<?=Yii::$app->request->baseUrl?>/uploads/<?=$model->image?>" alt="">
    </div>
    <div class="page__text">
        <span><?=$model->name?></span><br>
        <p><?=$model->content?></p>
    </div>
</div>