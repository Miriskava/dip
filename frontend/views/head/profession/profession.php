<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Профессиональные стандарты';
?>

    <h1><?=$this->title?></h1>
<?=Html::a('Добавить',['professioncreate'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'code',
        ['attribute'=>'name',
            'format' => 'raw',
            'value'=>function ($data) {
                return Html::a($data->name,['general','id'=>$data->id],[]);}],

        ['attribute'=>'date',
            'format' => ['date', 'dd.MM.Y']],

        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update}',
            'urlCreator' => function ($action, $model, $key, $index) {
                return Url::to(['head/professionupdate','id'=>$model->id]);
            },
            'contentOptions' => ['style' => 'width: 30px; max-width: 30px;'],
        ]
    ],
]); ?>