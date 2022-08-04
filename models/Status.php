<?php

namespace app\models;

use Yii;

/**
 * Класс модели для таблицы "status".
 *
 * @property int $id
 * @property string|null $name Статус ремонта
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
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
            'name' => 'Статус ремонта',
        ];
    }
}
