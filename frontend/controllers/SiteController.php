<?php
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
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
                        'roles' => ['@'],
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
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
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

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRole()
    {
        $userRole = Yii::$app->authManager->getRole('head');
        Yii::$app->authManager->assign($userRole, 3);
        return 123456;
    }

    public function actionDiscipline()
    {
        if(Yii::$app->user->can('head'))
            $this->layout='main';
        $searchModel = new DisciplineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('discipline',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionCreatediscipline()
    {
        if(Yii::$app->user->can('head'))
            $this->layout='main';
        $model=new Discipline();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['discipline']);
        } else {
            return $this->render('creatediscipline', [
                'model' => $model,
            ]);
        }
    }

    public function actionDisciplineone($id)
    {
        if(Yii::$app->user->can('head'))
            $this->layout='main';
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

    public function actionWorkfunlist($id,$sort)
    {
        $searchModel = new ActionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('workfunlist',[
            'dataProvider'=>$dataProvider,
            'id'=>$id,
        ]);
    }

    public function actionActionown($id)
    {
        if(Yii::$app->user->can('head'))
            $this->layout='main';
        $model=Action::find()->all();
        return $this->render('actionown',[
            'model'=>$model,
        ]);
    }
}
