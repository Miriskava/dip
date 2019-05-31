<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Discipline */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавление дисциплины';
?>
<div >
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            <?=$form->field($model,'id_user')->dropDownList($model->userlist)?>
            <br><h5 style="margin-left:10px">Учебный план</h5>
            <?= '<div style="overflow-y:scroll;height:250px"'.GridView::widget([
                'id'=>'rezult',
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
