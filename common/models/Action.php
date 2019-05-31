<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "action".
 *
 * @property int $id Номер
 * @property int $id_workfun Номер трудоввой функции
 * @property string $name Наименование
 *
 * @property AcDis[] $acDis
 * @property Discipline[] $disciplines
 * @property Workfunction $workfun
 * @property Own[] $owns
 */
class Action extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_workfun', 'name'], 'required'],
            [['id_workfun'], 'integer'],
            [['name'], 'string'],
            [['id_workfun'], 'exist', 'skipOnError' => true, 'targetClass' => Workfunction::className(), 'targetAttribute' => ['id_workfun' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_workfun' => 'Id Workfun',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcDis()
    {
        return $this->hasMany(AcDis::className(), ['id_action' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplines()
    {
        return $this->hasMany(Discipline::className(), ['id' => 'id_discipline'])->viaTable('ac_dis', ['id_action' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkfun()
    {
        return $this->hasOne(Workfunction::className(), ['id' => 'id_workfun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwns()
    {
        return $this->hasMany(Own::className(), ['id_sort' => 'id']);
    }
}
