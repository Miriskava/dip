<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Profession */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавление профессинального стандарта';
?>
<div >
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'code')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'date')->textInput() ?>

            <?= $form->field($model, 'aim')->textarea() ?>
            <br><h5 style="margin-left:10px">Учебный план</h5>
            <?= '<div style="overflow-y:scroll;height:250px"'.GridView::widget([
                'summary' => false,
                'dataProvider' => $dataProvider,
                'showHeader'=> false,
                'columns' => [

                    [
                        'class' => 'yii\grid\CheckboxColumn',
                    ],

                    'name',
                    'date',

                ],
            ]);?>

            <div class="form-group">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
