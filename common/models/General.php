<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "general".
 *
 * @property string $id Номер
 * @property string $id_profession Номер профессионального стандарта
 * @property string $code Код
 * @property string $name Наименование
 * @property string $level Уровень квалификации
 *
 * @property Profession $profession
 * @property Workfunction[] $workfunctions
 */
class General extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'general';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_profession', 'code', 'name', 'level'], 'required'],
            [['id_profession', 'level'], 'integer'],
            [['code'], 'string', 'max' => 1],
            [['name'], 'string', 'max' => 255],
            [['id_profession'], 'exist', 'skipOnError' => true, 'targetClass' => Profession::className(), 'targetAttribute' => ['id_profession' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_profession' => 'Id Profession',
            'code' => 'Code',
            'name' => 'Name',
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfession()
    {
        return $this->hasOne(Profession::className(), ['id' => 'id_profession']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkfunctions()
    {
        return $this->hasMany(Workfunction::className(), ['id_general' => 'id']);
    }
}
