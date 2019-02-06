<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "plan".
 *
 * @property string $id Номер
 * @property string $id_profession Номер профессионального стандарта
 * @property string $code Код направления
 * @property string $name Направление
 * @property string $date Дата утверждения
 *
 * @property Discipline[] $disciplines
 * @property Profession $profession
 * @property Profession[] $professions
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_profession'], 'integer'],
            [['code', 'name', 'date'], 'required'],
            [['date'], 'safe'],
            [['code'], 'string', 'max' => 8],
            [['name'], 'string', 'max' => 50],
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
            'id_profession' => 'Профессиональный стандарт',
            'code' => 'Code',
            'name' => 'Name',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplines()
    {
        return $this->hasMany(Discipline::className(), ['id_plan' => 'id']);
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
    public function getProfessions()
    {
        return $this->hasMany(Profession::className(), ['id_plan' => 'id']);
    }

    public function getProfList()
    {
        return ArrayHelper::map(Profession::find()->all(),'id','name');
    }
}
