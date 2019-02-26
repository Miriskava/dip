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

    public function actionDiscipline()
    {
        $searchModel = new DisciplineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('discipline',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionDisciplineone($id)
    {
        $one=Discipline::findOne($id);
        $actions=Action::find()->where(['id_discipline'=>$id])->all();
        $skills=Skill::find()->where(['id_discipline'=>$id])->all();
        $knowledges=Knowledge::find()->where(['id_discipline'=>$id])->all();

        return $this->render('disciplineone',[
            'one'=>$one,
            'actions'=>$actions,
            'skills'=>$skills,
            'knowledges'=>$knowledges,
        ]);
    }

    public function actionActionlist($id)
    {
        $searchModel = new ActionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('actionlist',[
            'dataProvider'=>$dataProvider,
            'id'=>$id,
        ]);
    }

    public function actionActionown($id)
    {
        $model=Action::find()->all();
        return $this->render('actionown',[
            'model'=>$model,
        ]);
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
        $searchModel = new ProfessionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('profession/profession',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
        ]);
    }
    public function actionCreateprofession()
    {
        $model=new Profession();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profession']);
        } else {
            return $this->render('createprofession', [
                'model' => $model,
            ]);
        }
    }

    public function actionGeneral($id)
    {
        $query=General::find()->where(['id_profession'=>$id]);
        $dataProvider=new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('profession/general',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionWorkfunction($id)
    {
        $query=Workfunction::find()->where(['id_general'=>$id]);
        $dataProvider=new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('profession/workfunction',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionSorts($id)
    {
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
        ]);
    }
}