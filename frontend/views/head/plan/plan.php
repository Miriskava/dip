<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

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

        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update}',
            'urlCreator' => function ($action, $model, $key, $index) {
                return Url::to(['head/updateplan','id'=>$model->id]);
            },
            'contentOptions' => ['style' => 'width: 30px; max-width: 30px;'],
        ]
    ],
]); ?>