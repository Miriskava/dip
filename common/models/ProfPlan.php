<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prof_plan".
 *
 * @property int $id_prof
 * @property int $id_plan
 *
 * @property Profession $prof
 * @property Plan $plan
 */
class ProfPlan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prof_plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_prof', 'id_plan'], 'required'],
            [['id_prof', 'id_plan'], 'integer'],
            [['id_prof', 'id_plan'], 'unique', 'targetAttribute' => ['id_prof', 'id_plan']],
            [['id_prof'], 'exist', 'skipOnError' => true, 'targetClass' => Profession::className(), 'targetAttribute' => ['id_prof' => 'id']],
            [['id_plan'], 'exist', 'skipOnError' => true, 'targetClass' => Plan::className(), 'targetAttribute' => ['id_plan' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_prof' => 'Id Prof',
            'id_plan' => 'Id Plan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProf()
    {
        return $this->hasOne(Profession::className(), ['id' => 'id_prof']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['id' => 'id_plan']);
    }
}
