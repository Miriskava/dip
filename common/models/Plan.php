<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property int $id Номер
 * @property string $code Код направления
 * @property string $name Направление
 * @property string $date Дата утверждения
 *
 * @property PlanDisc[] $planDiscs
 * @property Discipline[] $disciplines
 * @property ProfPlan[] $profPlans
 * @property Profession[] $profs
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'date'], 'required'],
            [['date'], 'safe'],
            [['code'], 'string', 'max' => 8],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanDiscs()
    {
        return $this->hasMany(PlanDisc::className(), ['id_plan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplines()
    {
        return $this->hasMany(Discipline::className(), ['id' => 'id_discipline'])->viaTable('plan_disc', ['id_plan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfPlans()
    {
        return $this->hasMany(ProfPlan::className(), ['id_plan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfs()
    {
        return $this->hasMany(Profession::className(), ['id' => 'id_prof'])->viaTable('prof_plan', ['id_plan' => 'id']);
    }
}
