<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
$form=ActiveForm::begin(['enableClientValidation'=>false]);
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
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
        [
            'label'=>'Переформулировка',
            'format' => 'raw',
            'value' => function ($data)use($form,$model) {
                return $form->field($model,'name')->textInput([])->label(false);
            },
        ]
    ],
]);
echo Html::submitButton('Далее',['class'=>'btn btn-primary']);
ActiveForm::end();