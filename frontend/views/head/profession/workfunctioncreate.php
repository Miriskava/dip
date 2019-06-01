<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Workfunction */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавление трудовой функции';
?>
<div >
    <h2><?=$prof->name?></h2>
    <h3><?=$this->title?></h3>


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'code')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'level')->textInput() ?>



            <div class="form-group">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
