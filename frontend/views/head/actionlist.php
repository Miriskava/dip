<?php
use yii\grid\GridView;
use yii\helpers\Html;

?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'name',

        ['class' => 'yii\grid\CheckboxColumn'],
    ],
]);
echo Html::a('Далее',['actionown','id'=>$id],['class'=>'btn btn-primary']);?>