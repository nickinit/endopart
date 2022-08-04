<?php

namespace app\models;

use Yii;

/**
 * Класс модели для таблицы "structure".
 *
 * @property int $id
 * @property string|null $name Отдел
 */
class Structure extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'structure';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Отдел',
        ];
    }
}
