<?php
/**
 * Created by PhpStorm.
 * User: Miroslava
 * Date: 16.12.2018
 * Time: 23:22
 */

namespace frontend\controllers;


use common\models\Action;
use common\models\ActionSearch;
use common\models\Discipline;
use common\models\DisciplineSearch;
use common\models\Knowledge;
use common\models\Skill;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;

class TeacherController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','discipline'],
                'rules' => [

                    [
                        'actions' => ['logout','discipline'],
                        'allow' => true,
                        'roles' => ['teacher'],
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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
}