<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

ActiveForm::begin();
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [

        [
            'class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function ($model, $key, $index, $column)use($check) {
                if($model->id_discipline==2)
                    return ['checked' => true];
                else
                    return ['checked' => false];
            }
        ],

        'name',



    ],
]);
echo Html::submitButton('Далее',['class'=>'btn btn-primary']);
ActiveForm::end();