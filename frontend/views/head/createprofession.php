<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Profession */

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
            <?= $form->field($model, 'id_plan')->dropDownList($model->planlist,['prompt'=>"Выберите..."]) ?>

            <div class="form-group">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
