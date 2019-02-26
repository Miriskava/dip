<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Трудовые функции';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?=$this->title?></h1>
<h2>Трудовые действия</h2>
<?=Html::a('Добавить',['createprofession'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $action,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<h2>Необходимые умения</h2>
<?=Html::a('Добавить',['createprofession'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $skill,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<h2>Необходимые знания</h2>
<?=Html::a('Добавить',['createprofession'],['class'=>'btn btn-success'])?>
<?= GridView::widget([
    'dataProvider' => $knowledge,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
