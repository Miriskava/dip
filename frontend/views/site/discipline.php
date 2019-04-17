<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Дисциплины';
?>
<h1><?=$this->title?></h1>
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