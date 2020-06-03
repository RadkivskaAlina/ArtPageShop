<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>
<div class="container">
    <?php
    $this->title = 'Про нас';
    $this->params['breadcrumbs'][] = $this->title;
    ?>
    <div class="">
        <div class="section_two__title">
            <p><?=$this->title?></p>
        </div>
        <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'options' =>[
                    'tag' => 'div',
                    'class' => 'about__wrapper',
                ],
                'itemView' => '_item__about',

                'layout' => "\n{items}\n{pager}"
            ])
            ?>
    </div>
</div>