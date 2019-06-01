<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Action */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<h2><?=$prof->name?></h2>
<?php

if($s==0){
    $head='трудового действия';
}
else if($s==1){
    $head='необходимого умения';
}
else{
    $head='необходимого знания';
}

$this->title = 'Добавление '.$head;
?>
<div >
    <h3><?= Html::encode($this->title) ?></h3>


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>


            <div class="form-group">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
