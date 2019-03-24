<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property int $id Номер
 * @property int $id_workfunction Номер трудоввой функции
 * @property int $id_discipline Номер дисциплины
 * @property string $name Наименование
 *
 * @property Can[] $cans
 * @property Discipline $discipline
 * @property Workfunction $workfunction
 */
class Skill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_workfunction', 'name'], 'required'],
            [['id_workfunction', 'id_discipline'], 'integer'],
            [['name'], 'string'],
            [['id_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['id_discipline' => 'id']],
            [['id_workfunction'], 'exist', 'skipOnError' => true, 'targetClass' => Workfunction::className(), 'targetAttribute' => ['id_workfunction' => 'id']],
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
    public function getCans()
    {
        return $this->hasMany(Can::className(), ['id_skill' => 'id']);
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
    public function getWorkfunction()
    {
        return $this->hasOne(Workfunction::className(), ['id' => 'id_workfunction']);
    }
}
