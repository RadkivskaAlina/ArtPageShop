<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Setting';
$this->params['breadcrumbs'][] = [
    'url' => Url::to(['/admin']),
    'label' => $this->title,
];
?>

<?php
Html::beginForm();
echo Html::label('Currency');
echo '<br>';
echo Html::input('text', 'Setting[value][currency]');
echo '<br>';
echo Html::label('Site name');
echo '<br>';
echo Html::input('text', 'Setting[value][site_name]');
echo '<br>';
echo Html::submitButton('save');
Html::endForm();
?>