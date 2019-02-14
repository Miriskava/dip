<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Профессиональные стандарты';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?=$this->title?></h1>
<?=Html::a('Добавить',['createprofession'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'code',
        'name',
        'date',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>