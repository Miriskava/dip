<?php
use yii\bootstrap\Tabs;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Трудовые функции';
?>

<h2><?=$prof->name?></h2>


<?php
for($i=0;$i<3;$i++) {
    if($i==0){
        $head='Трудовые действия';
        $s=$action;
    }
    else if($i==1){
        $head='Необходимые умения';
        $s=$skill;
    }
    else{
        $head='Необходимые знания';
        $s=$knowledge;
    }
    $t[$i] = [
        'label' => $head,
        'content' => '<h3>'.$head.'</h3>'.Html::a('Добавить',['createprofession'],['class'=>'btn btn-success']).
            GridView::widget([
                'dataProvider' => $s,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]),
        'headerOptions'=>['class'=>'he']
    ];
}
echo Tabs::widget([
    'items' =>$t,
    'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
    'clientOptions' => ['collapsible' => false],
]);
?>
