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
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) { return Html::a($data->name, ['disciplineone','id'=>$data->id]);}
        ],
        [
            'attribute' => 'user',
            'format' => 'raw',
            'value' => function ($data) {
                return $data->user->surname.' '.substr($data->user->name,0,2).'. '.substr($data->user->patronymic,0,2).'. ';}
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'buttons'  => [
                'leadView'   => function ($url, $model) {
                    $url = Url::to(['controller/lead-view', 'id' => $model->id]);
                    return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'view']);
                },
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url = 'index.php?r=client-login/lead-view&id=' . $model->id;
                        return $url;
                    }
                }
                ]
        ],
    ],
]); ?>