<?php
use yii\helpers\Html;

foreach ($model as $mod)
echo '<p><input id="1" name="vop2" type="checkbox" checked>'.$mod->name.'<input style="float: right" type="text"></p>';
echo Html::a('Далее',['discipline'],['class'=>'btn btn-primary']);