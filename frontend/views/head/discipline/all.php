<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Список дисциплин';
?>
<h1><?=$this->title?></h1>
<?=Html::a('Добавить',['creatediscipline'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width: 30px; max-width: 30px;'],
        ],

        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) { return Html::a($data->name, ['disciplineone','id'=>$data->id]);}
        ],
        [

            'contentOptions' => ['style' => 'width: 150px; max-width: 150px;'],
            'attribute' => 'user',
            'format' => 'raw',
            'value' => function ($data) {
                return $data->user->surname.' '.substr($data->user->name,0,2).'. '.substr($data->user->patronymic,0,2).'. ';}
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update}&nbsp;&nbsp;&nbsp;{delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
                if($action=='delete')return Url::to(['head/disciplinedelete','id'=>$model->id]);
                else return Url::to(['head/disciplineupdate','id'=>$model->id]);
            },
            'contentOptions' => ['style' => 'width: 60px; max-width: 60px;'],
        ],
    ],
]); ?>