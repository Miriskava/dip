<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kn_dis".
 *
 * @property int $id_discipline
 * @property int $id_knowledge
 *
 * @property Discipline $discipline
 * @property Knowledge $knowledge
 */
class KnDis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kn_dis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_discipline', 'id_knowledge'], 'required'],
            [['id_discipline', 'id_knowledge'], 'integer'],
            [['id_discipline', 'id_knowledge'], 'unique', 'targetAttribute' => ['id_discipline', 'id_knowledge']],
            [['id_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['id_discipline' => 'id']],
            [['id_knowledge'], 'exist', 'skipOnError' => true, 'targetClass' => Knowledge::className(), 'targetAttribute' => ['id_knowledge' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_discipline' => 'Id Discipline',
            'id_knowledge' => 'Id Knowledge',
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
    public function getKnowledge()
    {
        return $this->hasOne(Knowledge::className(), ['id' => 'id_knowledge']);
    }
}
