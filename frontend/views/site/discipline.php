<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Дисциплины';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?=$this->title?></h1>
<?php
if(Yii::$app->user->can('head')) echo Html::a('Добавить',['creatediscipline'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
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