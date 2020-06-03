<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PageCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Page Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Page Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'meta_title',
            'meta_description:ntext',
            'content:ntext',
            //'status',
            //'image',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
