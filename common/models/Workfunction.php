<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workfunction".
 *
 * @property string $id Номер
 * @property string $id_general Номер знаний
 * @property string $code Код
 * @property string $name Наименование
 * @property int $level Уровень квалификации
 *
 * @property Action[] $actions
 * @property Knowledge[] $knowledges
 * @property Skill[] $skills
 * @property General $general
 */
class Workfunction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workfunction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_general', 'code', 'name', 'level'], 'required'],
            [['id_general'], 'integer'],
            [['code'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 255],
            [['level'], 'string', 'max' => 1],
            [['id_general'], 'exist', 'skipOnError' => true, 'targetClass' => General::className(), 'targetAttribute' => ['id_general' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_general' => 'Id General',
            'code' => 'Code',
            'name' => 'Name',
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(Action::className(), ['id_workfun' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnowledges()
    {
        return $this->hasMany(Knowledge::className(), ['id_workfunction' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['id_workfunction' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneral()
    {
        return $this->hasOne(General::className(), ['id' => 'id_general']);
    }
}
