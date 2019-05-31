<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property int $id Номер
 * @property int $id_workfunction Номер трудоввой функции
 * @property string $name Наименование
 *
 * @property Can[] $cans
 * @property SkDis[] $skDis
 * @property Discipline[] $disciplines
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
    public function getCans()
    {
        return $this->hasMany(Can::className(), ['id_sort' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkDis()
    {
        return $this->hasMany(SkDis::className(), ['id_skill' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplines()
    {
        return $this->hasMany(Discipline::className(), ['id' => 'id_discipline'])->viaTable('sk_dis', ['id_skill' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkfunction()
    {
        return $this->hasOne(Workfunction::className(), ['id' => 'id_workfunction']);
    }
}
