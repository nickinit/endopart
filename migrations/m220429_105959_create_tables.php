<?php

use yii\db\Migration;

/**
 * Class m220429_105959_create_tables
 */
class m220429_105959_create_tables extends Migration
{

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('equipment', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'model' => $this->string()->notNull()->comment('Модель'),
            'year' => $this->integer()->notNull()->comment('Год выпуска'),
            'invno' => $this->string()->notNull()->comment('Инвентарный номер'),
            'serno' => $this->string()->comment('Серийный номер'),

        ], $tableOptions);

        $this->createTable('application', [
            'id' => $this->primaryKey(),
            'equipment_id' => $this->string()->notNull(),
            'status_id' => $this->string()->notNull(),
            'structure_id' => $this->string()->notNull(),

            'problem' => $this->text()->notNull()->comment('Описание неисправности'),
            'place' => $this->text()->notNull()->comment('Место нахождения'),

            'breakdown_date' => $this->integer()->notNull()->comment('Дата возникновения неисправности'),
            'repair_period' => $this->integer()->notNull()->comment('Сроки ремонта'),
            'attachment' => $this->string()->comment('Приложения'),
        ], $tableOptions);

        $this->createTable('structure', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Отдел'),
        ], $tableOptions);

        $this->createTable('status', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Статус ремонта'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('user');
    }
}
