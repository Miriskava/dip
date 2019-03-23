<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Дисциплины';
$this->params['breadcrumbs'][] = $this->title;

echo '<div class="row">'.
    Html::a('Управление трудовыми действиями',['workfunlist','id'=>$one->id,'sort'=>1],['class'=>'btn btn-warning']).' '.
    Html::a('Управление необходимыми знаниями',['workfunlist','id'=>$one->id,'sort'=>2],['class'=>'btn btn-success']).' '.
    Html::a('Управление необходимыми умениями',['workfunlist','id'=>$one->id,'sort'=>3],['class'=>'btn btn-primary']).
    '</div>';

echo '<h2>'.$one->name.'</h2>';
echo '<h3>Владеть:</h3>';
foreach ($actions as $act)
    echo '<li>'.$act->name.'</li>';
foreach ($own as $o)
    echo '<li>'.$o->name.'</li>';
echo '<h3>Знать:</h3>';
foreach ($knowledges as $knowledge)
    echo '<li>'.$knowledge->name.'</li>';
foreach ($know as $k)
    echo '<li>'.$k->name.'</li>';
echo '<h3>Уметь:</h3>';
foreach ($skills as $skill)
    echo '<li>'.$skill->name.'</li>';
foreach ($can as $c)
    echo '<li>'.$c->name.'</li>';