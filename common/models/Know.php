<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "know".
 *
 * @property int $id Номер 
 * @property int $id_discipline Номер дисциплины
 * @property string $name Наименование
 *
 * @property Knowledge $id0
 * @property Discipline $discipline
 */
class Know extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'know';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_discipline', 'name'], 'required'],
            [['id_discipline'], 'integer'],
            [['name'], 'string'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Knowledge::className(), 'targetAttribute' => ['id' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Knowledge::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }
}
