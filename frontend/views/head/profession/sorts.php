<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Трудовые функции';
?>

<h2><?=$prof->name?></h2>
<h3>Трудовые действия</h3>
<?=Html::a('Добавить',['createprofession'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $action,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<h3>Необходимые умения</h3>
<?=Html::a('Добавить',['createprofession'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $skill,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<h3>Необходимые знания</h3>
<?=Html::a('Добавить',['createprofession'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $knowledge,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
