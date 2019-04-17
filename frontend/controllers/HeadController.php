<?php
/**
 * Created by PhpStorm.
 * User: Miroslava
 * Date: 16.12.2018
 * Time: 23:48
 */

namespace frontend\controllers;


use common\models\Action;
use common\models\ActionSearch;
use common\models\Discipline;
use common\models\DisciplineSearch;
use common\models\General;
use common\models\Knowledge;
use common\models\Plan;
use common\models\PlanDisc;
use common\models\PlanSearch;
use common\models\Profession;
use common\models\ProfessionSearch;
use common\models\SearchGeneral;
use common\models\Skill;
use common\models\Workfunction;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;

class HeadController extends Controller
{
    public $layout='main';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['profession','plan'],
                'rules' => [

                    [
                        'actions' => ['profession','plan'],
                        'allow' => true,
                        'roles' => ['head'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionPlan()
    {
        $searchModel = new PlanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('plan',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionCreateplan()
    {
        $model=new Plan();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['plan']);
        } else {
            return $this->render('createplan', [
                'model' => $model,
            ]);
        }
    }

    public function actionProfession()
    {
        $query = Profession::find();
        $dataProvider = new ActiveDataProvider(['query'=>$query]);
        return $this->render('profession/profession',[
            'dataProvider'=>$dataProvider,
        ]);
    }
    public function actionCreateprofession()
    {
        $model=new Profession();
        $query=Plan::find();
        $dataProvider=new ActiveDataProvider(['query'=>$query]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profession']);
        } else {
            return $this->render('createprofession', [
                'model' => $model,
                'dataProvider'=>$dataProvider,
            ]);
        }
    }

    public function actionGeneral($id)
    {
        $prof=Profession::findOne($id);
        $query=General::find()->where(['id_profession'=>$id]);
        $dataProvider=new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('profession/general',[
            'dataProvider'=>$dataProvider,
            'prof'=>$prof,
        ]);
    }

    public function actionWorkfunction($id,$prof)
    {
        $p=Profession::findOne($prof);
        $query=Workfunction::find()->where(['id_general'=>$id]);
        $dataProvider=new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('profession/workfunction',[
            'dataProvider'=>$dataProvider,
            'prof'=>$p,
        ]);
    }

    public function actionSorts($id,$prof)
    {
        $p=Profession::findOne($prof);

        $query1=Action::find()->where(['id_workfun'=>$id]);
        $action=new ActiveDataProvider([
            'query' => $query1,
        ]);

        $query2=Skill::find()->where(['id_workfunction'=>$id]);
        $skill=new ActiveDataProvider([
            'query' => $query2,
        ]);

        $query3=Knowledge::find()->where(['id_workfunction'=>$id]);
        $knowledge=new ActiveDataProvider([
            'query' => $query3,
        ]);
        return $this->render('profession/sorts',[
            'action'=>$action,
            'skill'=>$skill,
            'knowledge'=>$knowledge,
            'prof'=>$p,
        ]);
    }

    public function actionAll(){
        $query=Discipline::find();
        $dataProvaider=new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('profession/all',[
            'dataProvider'=>$dataProvaider,
        ]);
    }

    public function actionCreatediscipline()
    {
        if (Yii::$app->user->can('head'))
            $this->layout = 'main';
        $model = new Discipline();
        $searchModel=new PLanSearch;
        $dataProvider=$searchModel->search(Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $check_plan=Yii::$app->request->post('selection');
            for($i=0;$i<count($check_plan);$i++) {
                $plan_dis[$i]=new PlanDisc();
                $plan_dis[$i]->id_discipline=$model->id;
                $plan_dis[$i]->id_plan=$check_plan[$i];
                $plan_dis[$i]->save();
            }
            return $this->redirect(['discipline']);
        } else {
            return $this->render('creatediscipline', [
                'model' => $model,
                'dataProvider'=>$dataProvider,
                'searchModel'=>$searchModel,
            ]);
        }
    }

}