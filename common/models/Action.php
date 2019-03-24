<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "action".
 *
 * @property int $id Номер
 * @property int $id_workfun Номер трудоввой функции
 * @property int $id_discipline Номер дисциплины
 * @property string $name Наименование
 *
 * @property Discipline $discipline
 * @property Workfunction $workfun
 * @property Own[] $owns
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
            [['id', 'id_workfun', 'name'], 'required'],
            [['id', 'id_workfun', 'id_discipline'], 'integer'],
            [['name'], 'string'],
            [['id'], 'unique'],
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
            'id' => 'ID',
            'id_workfun' => 'Трудовая функция',
            'id_discipline' => 'Дисциплина',
            'name' => 'Наименование',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwns()
    {
        return $this->hasMany(Own::className(), ['id_action' => 'id']);
    }
}
