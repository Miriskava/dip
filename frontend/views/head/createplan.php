<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Plan */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавление учебного плана';
$this->params['breadcrumbs'][] = $this->title;
?>
<div >
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'code')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'date')->textInput() ?>
            <?= $form->field($model, 'id_profession')->dropDownList($model->proflist) ?>

            <div class="form-group">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
