<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "own".
 *
 * @property int $id Номер
 * @property int $id_discipline Номер дисциплины
 * @property string $name Наименование
 * @property int $id_action
 *
 * @property Action $action
 * @property Discipline $discipline
 */
class Own extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'own';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_discipline', 'name', 'id_action'], 'required'],
            [['id_discipline', 'id_action'], 'integer'],
            [['name'], 'string'],
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
            'id' => 'ID',
            'id_discipline' => 'Id Discipline',
            'name' => 'Name',
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
