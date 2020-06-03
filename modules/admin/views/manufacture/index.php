<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ManufactureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manufactures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacture-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Manufacture', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'image',
            'status',
            'pos',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
