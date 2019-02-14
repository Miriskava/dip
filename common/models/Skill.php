<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property string $id Номер
 * @property string $id_workfunction Номер трудоввой функции
 * @property string $id_discipline Номер дисциплины
 * @property string $name Наименование
 *
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
            'id_workfunction' => 'Id Workfunction',
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
    public function getWorkfunction()
    {
        return $this->hasOne(Workfunction::className(), ['id' => 'id_workfunction']);
    }
}
