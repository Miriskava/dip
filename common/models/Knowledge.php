<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "knowledge".
 *
 * @property int $id Номер
 * @property int $id_workfunction Номер трудоввой функции
 * @property string $name Наименование
 *
 * @property KnDis[] $knDis
 * @property Discipline[] $disciplines
 * @property Know[] $knows
 * @property Workfunction $workfunction
 */
class Knowledge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'knowledge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_workfunction', 'name'], 'required'],
            [['id_workfunction'], 'integer'],
            [['name'], 'string'],
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
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnDis()
    {
        return $this->hasMany(KnDis::className(), ['id_knowledge' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplines()
    {
        return $this->hasMany(Discipline::className(), ['id' => 'id_discipline'])->viaTable('kn_dis', ['id_knowledge' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnows()
    {
        return $this->hasMany(Know::className(), ['id_sort' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkfunction()
    {
        return $this->hasOne(Workfunction::className(), ['id' => 'id_workfunction']);
    }
}
