<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "discipline".
 *
 * @property int $id Номер
 * @property string $name Наименование
 * @property int $id_user
 *
 * @property Action[] $actions
 * @property Can[] $cans
 * @property User $user
 * @property Know[] $knows
 * @property Knowledge[] $knowledges
 * @property Own[] $owns
 * @property PlanDisc[] $planDiscs
 * @property Plan[] $plans
 * @property Skill[] $skills
 */
class Discipline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discipline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_user'], 'required'],
            [['name'], 'string'],
            [['id_user'], 'safe'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'id_user' => 'Id User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(Action::className(), ['id_discipline' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCans()
    {
        return $this->hasMany(Can::className(), ['id_discipline' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    public function getUserList()
    {
        return ArrayHelper::map(User::find()->andWhere(['!=','id',1])->all(),'id','surname');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnows()
    {
        return $this->hasMany(Know::className(), ['id_discipline' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnowledges()
    {
        return $this->hasMany(Knowledge::className(), ['id_discipline' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwns()
    {
        return $this->hasMany(Own::className(), ['id_discipline' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanDiscs()
    {
        return $this->hasMany(PlanDisc::className(), ['id_discipline' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['id' => 'id_plan'])->viaTable('plan_disc', ['id_discipline' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['id_discipline' => 'id']);
    }
}
