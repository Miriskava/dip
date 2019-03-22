<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
    <?php
ActiveForm::begin();
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',

        ],

        'name',

        [
            'class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function ($model, $key, $index, $column)use($id) {
                if($model->id_discipline==$id)
                    return ['checked' => true];
                else
                    return ['checked' => false];
            }
        ],
    ],
]);
echo Html::submitButton('Далее',['class'=>'btn btn-primary']);//Html::a('Далее',['actionown','id'=>$id],['class'=>'btn btn-primary']);
ActiveForm::end();
?>

