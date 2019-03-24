<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Обобщенные трудовые функции';
?>

    <h1><?=$this->title?></h1>
<?=Html::a('Добавить',['createprofession'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'code',
        ['attribute'=>'name',
            'format' => 'raw',
            'value'=>function ($data) {
                return Html::a($data->name,['workfunction','id'=>$data->id],[]);}
        ],
        'level',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>