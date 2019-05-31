<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ac_dis".
 *
 * @property int $id_discipline
 * @property int $id_action
 *
 * @property Action $action
 * @property Discipline $discipline
 */
class AcDis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ac_dis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_discipline', 'id_action'], 'required'],
            [['id_discipline', 'id_action'], 'integer'],
            [['id_discipline', 'id_action'], 'unique', 'targetAttribute' => ['id_discipline', 'id_action']],
            [['id_action'], 'exist', 'skipOnError' => true, 'targetClass' => Action::className(), 'targetAttribute' => ['id_action' => 'id']],
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
            'id_action' => 'Id Action',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(Action::className(), ['id' => 'id_action']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }
}
