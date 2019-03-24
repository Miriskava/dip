<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Учебные планы';
?>
    <h1><?=$this->title?></h1>
<?=Html::a('Добавить',['createplan'],['class'=>'btn btn-success'])?>
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