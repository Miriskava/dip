<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plan_disc".
 *
 * @property int $id_discipline
 * @property int $id_plan
 *
 * @property Plan $plan
 * @property Discipline $discipline
 */
class PlanDisc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan_disc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_discipline', 'id_plan'], 'required'],
            [['id_discipline', 'id_plan'], 'integer'],
            [['id_discipline', 'id_plan'], 'unique', 'targetAttribute' => ['id_discipline', 'id_plan']],
            [['id_plan'], 'exist', 'skipOnError' => true, 'targetClass' => Plan::className(), 'targetAttribute' => ['id_plan' => 'id']],
            [['id_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['id_discipline' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_discipline' => 'Id Discipline',
            'id_plan' => 'Id Plan',
        ];
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
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }
}
