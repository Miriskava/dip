<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "discipline".
 *
 * @property string $id Номер
 * @property string $id_plan Номер учебного плана
 * @property string $name Наименование
 *
 * @property Action[] $actions
 * @property Can[] $cans
 * @property Plan $plan
 * @property Know[] $knows
 * @property Knowledge[] $knowledges
 * @property Own[] $owns
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
            [['id_plan', 'name'], 'required'],
            [['id_plan'], 'integer'],
            [['name'], 'string'],
            [['id_plan'], 'exist', 'skipOnError' => true, 'targetClass' => Plan::className(), 'targetAttribute' => ['id_plan' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_plan' => 'Учебный план',
            'name' => 'Наименование',
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
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['id' => 'id_plan']);
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
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['id_discipline' => 'id']);
    }

    public function getPlanList()
    {
        return ArrayHelper::map(Plan::find()->all(),'id','name','date');
    }
}
