<?php
use yii\grid\GridView;
use yii\helpers\Html;

?>
<?php
$str='Трудовые действия';
switch($sort) {
    case 1:
        $str = 'Трудовые действия';
        break;
    case 2:
        $str = 'Необходимые знания';
        break;
    case 3:
        $str = 'Необходимые умения';
        break;
    default:break;
}
?><h1><?=$str?></h1>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'name',

        ['class' => 'yii\grid\CheckboxColumn'],
    ],
]);
echo Html::a('Далее',['actionown','id'=>$id],['class'=>'btn btn-primary']);?>