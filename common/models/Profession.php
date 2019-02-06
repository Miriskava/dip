<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "profession".
 *
 * @property string $id Номер
 * @property string $id_plan Номер учебного плана
 * @property string $code Код
 * @property string $name Наименование
 * @property string $date Дата утверждения
 * @property string $aim Основная цель деятельности
 *
 * @property General[] $generals
 * @property Plan[] $plans
 * @property Plan $plan
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
            [['id_plan', 'code', 'name', 'date', 'aim'], 'required'],
            [['id_plan'], 'integer'],
            [['date'], 'safe'],
            [['aim'], 'string'],
            [['code'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 255],
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
            'code' => 'Код',
            'name' => 'Наименование ',
            'date' => 'Дата утверждения',
            'aim' => 'Основная цель вида профессиональной деятельности',
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
    public function getPlans()
    {
        return $this->hasMany(Plan::className(), ['id_profession' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['id' => 'id_plan']);
    }

    public function getPlanList()
    {
        return ArrayHelper::map(Plan::find()->all(),'id','name','date');
    }
}
