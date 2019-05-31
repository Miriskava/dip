<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sk_dis".
 *
 * @property int $id_discipline
 * @property int $id_skill
 *
 * @property Discipline $discipline
 * @property Skill $skill
 */
class SkDis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sk_dis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_discipline', 'id_skill'], 'required'],
            [['id_discipline', 'id_skill'], 'integer'],
            [['id_discipline', 'id_skill'], 'unique', 'targetAttribute' => ['id_discipline', 'id_skill']],
            [['id_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['id_discipline' => 'id']],
            [['id_skill'], 'exist', 'skipOnError' => true, 'targetClass' => Skill::className(), 'targetAttribute' => ['id_skill' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_discipline' => 'Id Discipline',
            'id_skill' => 'Id Skill',
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
    public function getSkill()
    {
        return $this->hasOne(Skill::className(), ['id' => 'id_skill']);
    }
}
