<?php
use yii\bootstrap\Collapse;

?>
<h2>Покрытие стандарта дисциплинами</h2>
<?php

foreach ($prof as $pr) {

    foreach ($general->where(['id_profession'=>$pr->id])->all() as $gen){

        foreach ($workfun->where(['id_general'=>$gen->id])->all() as $wf){

            for($i=0;$i<3;$i++){
                if($i==0){
                    $resa = \Yii::$app->db->createCommand("CALL coverage_sort_dis(@r,:sort,:workfun);")
                        ->bindValue(':sort' , 1)
                        ->bindValue(':workfun' , $wf->id)->execute();
                    $reza=Yii::$app->db->createCommand("SELECT @r;")->queryScalar();
                    $ra=(double)$reza;
                    $head='Трудовые действия';
                    foreach ($action->where(['id_workfunction'=>$wf->id])->all() as $ac){
                        $acname[$ac->id_workfunction][]=$ac->name.'<br>';
                    }
                    $ac_item[$ac->id_workfunction][]=[
                        'label' => '<div class="name">'.$head.'<div class="cr">'.$ra.'</div></div>',
                        'content' => $acname[$ac->id_workfunction],
                        'options' => ['class' => 'fourhead'],
                    ];
                    $tf[0] = Collapse::widget([
                        'encodeLabels' => false,
                        'items' => $ac_item[$ac->id_workfunction],
                    ]);
                }
                else if($i==1){
                    $ress = \Yii::$app->db->createCommand("CALL coverage_sort_dis(@r,:sort,:workfun);")
                        ->bindValue(':sort' , 3)
                        ->bindValue(':workfun' , $wf->id)->execute();
                    $rezs=Yii::$app->db->createCommand("SELECT @r;")->queryScalar();
                    $rs=(double)$rezs;
                    $head='Необходимые умения';
                    foreach ($skill->where(['id_workfunction'=>$wf->id])->all() as $sk){
                        $skname[$sk->id_workfunction][]=$sk->name.'<br>';
                    }
                    $sk_item[$sk->id_workfunction][]=[
                        'label' => '<div class="name">'.$head.'<div class="cr">'.$rs.'</div></div>',
                        'content' => $skname[$ac->id_workfunction],
                        'options' => ['class' => 'fourhead'],
                    ];
                    $tf[1] = Collapse::widget([
                        'encodeLabels' => false,
                        'items' => $sk_item[$sk->id_workfunction],
                    ]);
                }
                else{
                    $resk = \Yii::$app->db->createCommand("CALL coverage_sort_dis(@r,:sort,:workfun);")
                        ->bindValue(':sort' , 2)
                        ->bindValue(':workfun' , $wf->id)->execute();
                    $rezk=Yii::$app->db->createCommand("SELECT @r;")->queryScalar();
                    $rk=(double)$rezk;
                    $head='Необходимые знания';
                    foreach ($knowledge->where(['id_workfunction'=>$wf->id])->all() as $kn){
                        $knname[$kn->id_workfunction][]=$kn->name.'<br>';
                    }
                    $kn_item[$kn->id_workfunction][]=[
                        'label' => '<div class="name">'.$head.'<div class="cr">'.$rk.'</div></div>',
                        'content' => $knname[$kn->id_workfunction],
                        'options' => ['class' => 'fourhead'],
                    ];
                    $tf[2] = Collapse::widget([
                        'encodeLabels' => false,
                        'items' => $kn_item[$kn->id_workfunction],
                    ]);
                }
            }
            $resw = \Yii::$app->db->createCommand("CALL coverage_workfun_dis(@r,:workfun);")
                ->bindValue(':workfun' , $wf->id)->execute();
            $rezw=Yii::$app->db->createCommand("SELECT @r;")->queryScalar();
            $rw=(double)$rezw;
            $wf_item[$wf->id_general][]=[
                'label' => '<div class="name">'.$wf->name.'<div class="cr">'.$rw.'</div></div>',
                'content' => $tf,
                'options' => ['class' => 'threehead'],
            ];
        }

        $w = Collapse::widget([
            'encodeLabels' => false,
            'items' => $wf_item[$wf->id_general],
        ]);

        $resg = \Yii::$app->db->createCommand("CALL coverage_general_dis(@r,:general);")
            ->bindValue(':general' , $gen->id)->execute();
        $rezg=Yii::$app->db->createCommand("SELECT @r;")->queryScalar();
        $rg=(double)$rezg;

        $gen_item[$gen->id_profession][]=[
            'label' => '<div class="name">'.$gen->name.'<div class="cr">'.$rg.'</div></div>',
            'content' => $w,
            'options' => ['class' => 'twohead'],
        ];
    }

    $g = Collapse::widget([
        'encodeLabels' => false,
        'items' => $gen_item[$gen->id_profession],
    ]);

    $resp = \Yii::$app->db->createCommand("CALL coverage_prof_dis(@r,:prof);")
        ->bindValue(':prof' , $pr->id)->execute();
    $rezp=Yii::$app->db->createCommand("SELECT @r;")->queryScalar();
    $rp=(double)$rezp;

    $pr_item[]=[
        'label' => '<div class="name">'.$pr->name.'<div class="cr">'.$rp.'</div></div>',
        'content' => $g,
        'options' => ['class' => 'onehead'],
    ];
}

    echo Collapse::widget([
        'encodeLabels' => false,
        'items' => $pr_item,
    ]);
?>