<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Профессиональные стандарты';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?=$this->title?></h1>
<?=Html::a('Добавить',['createprofession'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'code',
<<<<<<< Updated upstream:frontend/views/head/profession.php
        'name',
        'date',
=======
        ['attribute'=>'name',
            'format' => 'raw',
            'value'=>function ($data) {
                return Html::a($data->name,['viewprofession','id'=>$data->id],[]);}],

        ['attribute'=>'date',
            'format' => ['date', 'dd.MM.Y']],
>>>>>>> Stashed changes:frontend/views/head/profession/profession.php

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>