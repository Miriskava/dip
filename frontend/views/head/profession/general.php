<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Обобщенные трудовые функции';
?>
<h2><?=$prof->name?></h2>
    <h3><?=$this->title?></h3>
<?=Html::a('Добавить',['generalcreate','id'=>$prof->id],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'code',
        ['attribute'=>'name',
            'format' => 'raw',
            'value'=>function ($data)use($prof) {
                return Html::a($data->name,['workfunction','id'=>$data->id,'prof'=>$prof->id],[]);}
        ],
        'level',
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update}',
            'urlCreator' => function ($action, $model, $key, $index) use($prof){
                return Url::to(['head/generalupdate','id'=>$model->id,'prof'=>$prof->id]);
            },
            'contentOptions' => ['style' => 'width: 30px; max-width: 30px;'],
        ]
    ],
]); ?>