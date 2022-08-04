<?php

use yii\db\Migration;

/**
 * Class m220428_190907_init_rbac
 */
class m220428_190907_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // добавьте роль user
        $user = $auth->createRole('user');
        $auth->add($user);

        // добавить роль «admin»
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user);

        // Задаем пользователю с id=1 роль администратора
        $auth->assign($admin, 1);
        $auth->assign($user, 2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220428_190907_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220428_190907_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
