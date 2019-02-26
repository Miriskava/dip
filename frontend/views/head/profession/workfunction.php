<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Трудовые функции';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?=$this->title?></h1>
<?=Html::a('Добавить',['createprofession'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'code',
        ['attribute'=>'name',
            'format' => 'raw',
            'value'=>function ($data) {
                return Html::a($data->name,['sorts','id'=>$data->id],[]);}
        ],
        'level',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>