<?php

use yii\db\Migration;

class m250319_192157_init_rbac extends Migration
{
    public function safeUp()
    {
        $auth = new \yii\rbac\DbManager();
        $auth->init();

        // Создаем роли
        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);

        $userRole = $auth->createRole('user');
        $auth->add($userRole);

        // Назначаем роли пользователям
        $auth->assign($adminRole, 1); // admin
        $auth->assign($userRole, 2); // user
    }

    public function safeDown()
    {
        $auth = new \yii\rbac\DbManager();
        $auth->init();

        $auth->removeAll();
    }
}
