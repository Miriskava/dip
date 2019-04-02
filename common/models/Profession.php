<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profession".
 *
 * @property int $id Номер
 * @property string $code Код
 * @property string $name Наименование
 * @property string $date Дата утверждения
 * @property string $aim Основная цель деятельности
 *
 * @property General[] $generals
 * @property ProfPlan[] $profPlans
 * @property Plan[] $plans
 */
class Profession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profession';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'date', 'aim'], 'required'],
            [['date'], 'safe'],
            [['aim'], 'string'],
            [['code'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 255],
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
            'aim' => 'Aim',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenerals()
    {
        return $this->hasMany(General::className(), ['id_profession' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfPlans()
    {
        return $this->hasMany(ProfPlan::className(), ['id_prof' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['id' => 'id_plan'])->viaTable('prof_plan', ['id_prof' => 'id']);
    }
}
