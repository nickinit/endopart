<?php

namespace app\models;

use Yii;

/**
 * Класс модели для таблицы "equipment".
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $model Модель
 * @property int $year Год выпуска
 * @property string $invno Инвентарный номер
 * @property string|null $serno Серийный номер
 */
class Equipment extends \yii\db\ActiveRecord
{
    public $isNew;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'model', 'year', 'invno'], 'required'],
            [['year'], 'integer'],
            [['year'], 'validateYear'],
            ['isNew', 'safe'],
            ['serno', 'unique'],
            [['name', 'model', 'invno', 'serno'], 'string', 'max' => 255],
        ];
    }

    /**
     * Валидации аттрибута year
     * @param $attribute
     * @param $params
     * @return void
     */
    public function validateYear($attribute, $params)
    {
        if ($this->$attribute < 1900 || $this->$attribute > date('Y')) {
            $this->addError($attribute, 'Неверно задан год выпуска оборудования.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'model' => 'Модель',
            'year' => 'Год выпуска',
            'invno' => 'Инвентарный номер',
            'serno' => 'Серийный номер',
        ];
    }

}
