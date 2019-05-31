<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Дисциплины';
?>
<h1><?=$this->title?></h1>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'options' => ['style' => 'width: 30px; max-width: 30px;'],
            'contentOptions' => ['style' => 'width: 30px; max-width: 30px;'],
        ],

        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) { return Html::a($data->name, ['disciplineone','id'=>$data->id]);}
        ],
    ],
]); ?>