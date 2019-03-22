<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "know".
 *
 * @property int $id Номер 
 * @property int $id_discipline Номер дисциплины
 * @property string $name Наименование
 * @property int $id_knowledge
 *
 * @property Knowledge $knowledge
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
            [['id_discipline', 'name', 'id_knowledge'], 'required'],
            [['id_discipline', 'id_knowledge'], 'integer'],
            [['name'], 'string'],
            [['id_knowledge'], 'exist', 'skipOnError' => true, 'targetClass' => Knowledge::className(), 'targetAttribute' => ['id_knowledge' => 'id']],
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
            'id_knowledge' => 'Id Knowledge',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnowledge()
    {
        return $this->hasOne(Knowledge::className(), ['id' => 'id_knowledge']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }
}
