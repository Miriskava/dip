<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "can".
 *
 * @property int $id Номер
 * @property int $id_discipline Номер дисциплины
 * @property string $name Наименование
 * @property int $id_sort
 *
 * @property Skill $sort
 * @property Discipline $discipline
 */
class Can extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'can';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_discipline', 'name', 'id_sort'], 'required'],
            [['id_discipline', 'id_sort'], 'integer'],
            [['name'], 'string'],
            [['id_sort'], 'exist', 'skipOnError' => true, 'targetClass' => Skill::className(), 'targetAttribute' => ['id_sort' => 'id']],
            [['id_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['id_discipline' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_discipline' => 'Дисциплина',
            'name' => 'Наименование',
            'id_sort' => 'Необходимое умение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSort()
    {
        return $this->hasOne(Skill::className(), ['id' => 'id_sort']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }
}
