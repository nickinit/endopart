<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;
use app\models\User;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionAddUser() {
        $username = Console::prompt('Введите имя пользователя:');
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $password = Console::prompt('Введите пароль:');
            $user = new User();
            $user->username = $username;
            $email = Console::prompt('Введите e-mail');
//            $user->email = $email;
            $user->setPassword($password);
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'good';
            }
        }
    }
}
