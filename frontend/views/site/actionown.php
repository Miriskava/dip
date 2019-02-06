<?php
use yii\helpers\Html;
echo '<h1>Трудовые действия и владеть</h1>';
foreach ($model as $mod)
echo '<h4 style="height: 50px;"><input id="1" name="vop2" type="checkbox" checked>'.$mod->name.'<input style="height: 50px;width: 400px;float: right" type="text"></h4>';
echo Html::a('Далее',['discipline'],['class'=>'btn btn-primary']);