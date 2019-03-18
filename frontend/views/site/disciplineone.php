
<script type="text/javascript">
    $(function() {
        function res(){
            var k=0;
            if($("#1").prop('checked'))k++;
            if($("#2").prop('checked'))k++;
            if($("#3").prop('checked'))k++;
        }
    });
</script>

<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->title = 'Дисциплины';
$this->params['breadcrumbs'][] = $this->title;

$sort=0;
Modal::begin([
    'id'=>'dialog',
    'header' => '<h2>Выберите...</h2>',
    'toggleButton' => ['label' => 'Изменить','class'=>'btn btn-success'],
]);
echo '<p><input id="1" name="vop2" type="radio" value="0" checked><label for="1">Трудовые действия</label></p>
      <p><input id="2" name="vop2" type="radio" value="1"><label for="2">Необходимые знания</label></p>
      <p><input id="3" name="vop2" type="radio" value="2"><label for="3">Необходимые умения</label></p>';
echo Html::a('Далее',['workfunlist','id'=>$one->id,'sort'=>$sort],['class'=>'btn btn-primary',
    'onClick'=>"
    if($('#1').prop('checked'))".$sort."=0;
    if($('#2').prop('checked'))".$sort."=1;
    if($('#3').prop('checked'))".$sort."=2;
    "]);
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
