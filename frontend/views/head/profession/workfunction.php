<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Трудовые функции';
?>

    <h2><?=$prof->name?></h2>
    <h3><?=$this->title?></h3>
<?=Html::a('Добавить',['createprofession'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'code',
        ['attribute'=>'name',
            'format' => 'raw',
            'value'=>function ($data)use($prof) {
                return Html::a($data->name,['sorts','id'=>$data->id,'prof'=>$prof->id],[]);}
        ],
        'level',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>