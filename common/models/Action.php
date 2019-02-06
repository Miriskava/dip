<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "action".
 *
 * @property string $id_action Номер
 * @property string $id_workfun Номер трудоввой функции
 * @property string $id_discipline Номер дисциплины
 * @property string $name Наименование
 *
 * @property Discipline $discipline
 * @property Workfunction $workfun
 */
class Action extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_workfun', 'name'], 'required'],
            [['id_workfun', 'id_discipline'], 'integer'],
            [['name'], 'string'],
            [['id_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['id_discipline' => 'id']],
            [['id_workfun'], 'exist', 'skipOnError' => true, 'targetClass' => Workfunction::className(), 'targetAttribute' => ['id_workfun' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_action' => 'Id Action',
            'id_workfun' => 'Id Workfun',
            'id_discipline' => 'Id Discipline',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkfun()
    {
        return $this->hasOne(Workfunction::className(), ['id' => 'id_workfun']);
    }
}
