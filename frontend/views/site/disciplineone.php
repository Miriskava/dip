<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->title = 'Дисциплины';
$this->params['breadcrumbs'][] = $this->title;


Modal::begin([
    'header' => '<h2>Выберите...</h2>',
    'toggleButton' => ['label' => 'Изменить','class'=>'btn btn-success'],
]);
echo '<p><input id="1" name="vop2" type="radio" value="0" checked> Трудовые действия</p>
                    <p><input id="2" name="vop2" type="radio" value="1"> Необходимые знания</p>
                    <p><input id="3" name="vop2" type="radio" value="2"> Необходимые умения</p>';
echo Html::a('Далее',['actionlist','id'=>$one->id],['class'=>'btn btn-primary']);
Modal::end();

echo '<h2>'.$one->name.'</h2>';
echo '<h3>Владеть:</h3>';
foreach ($actions as $act)
    echo '<li>'.$act->name.'</li>';
echo '<h3>Знать:</h3>';
foreach ($knowledges as $know)
    echo '<li>'.$know->name.'</li>';
echo '<h3>Уметь:</h3>';
foreach ($skills as $skill)
    echo '<li>'.$skill->name.'</li>';
