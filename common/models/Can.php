<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "can".
 *
 * @property int $id Номер
 * @property int $id_discipline Номер дисциплины
 * @property string $name Наименование
 * @property int $id_skill
 *
 * @property Skill $skill
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
            [['id_discipline', 'name', 'id_skill'], 'required'],
            [['id_discipline', 'id_skill'], 'integer'],
            [['name'], 'string'],
            [['id_skill'], 'exist', 'skipOnError' => true, 'targetClass' => Skill::className(), 'targetAttribute' => ['id_skill' => 'id']],
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
            'id_skill' => 'Id Skill',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(Skill::className(), ['id' => 'id_skill']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }
}
