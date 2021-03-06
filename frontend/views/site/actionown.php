<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$i=0;
$str='Владеть';
switch($sort) {
    case 1:
        $str = 'Владеть';
        break;
    case 2:
        $str = 'Знать';
        break;
    case 3:
        $str = 'Уметь';
        break;
    default:break;
}
echo '<h1>'.$str.'</h1>';
echo '<div class="row"><div class="col-md-6 order-md-1"> ';
echo '<h4>Трудовые функции:</h4>';
$form=ActiveForm::begin(['enableClientValidation'=>false]);
echo \yii\grid\GridView::widget([
    'id'=>'rezult',
    'summary' => false,
    'dataProvider' => $dataProvider,
    'showHeader'=> false,
    'columns' => [

        [
            'class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function ($model, $key, $index, $column)use($check) {
                if (in_array($model->id,$check))
                        return ['checked' => true];
                    else
                        return ['checked' => false];
            }
        ],

        'name',

    ],
]);
echo Html::submitButton('Далее',['class'=>'btn btn-primary']);
echo '</div><div class="col-md-6 order-md-2 form">';
echo '<h4>Переформулировка:</h4>';
foreach ($model as $index=>$mod)
    echo $form->field($mod,"[$index]name")->textarea(['rows'=>2])->label(false);
echo '</div></div>';
ActiveForm::end();