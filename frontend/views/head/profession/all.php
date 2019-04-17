<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Список дисциплин';
?>
<h1><?=$this->title?></h1>
<?=Html::a('Добавить',['creatediscipline'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) { return Html::a($data->name, ['disciplineone','id'=>$data->id]);}
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>