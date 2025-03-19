<?php

use yii\db\Migration;

class m250319_191841_add_users extends Migration
{
    public function safeUp()
    {
        $this->batchInsert(\app\models\User::tableName(), [
            'username',
            'auth_key',
            'password_hash',
            'email',
            'status',
            'created_at',
            'updated_at',
        ], [
            [
                'admin',
                \Yii::$app->security->generateRandomString(),
                \Yii::$app->security->generatePasswordHash('password'),
                'admin@example.com',
                10,
                time(),
                time(),
            ],
            [
                'user',
                \Yii::$app->security->generateRandomString(),
                \Yii::$app->security->generatePasswordHash('user'),
                'user@example.com',
                10,
                time(),
                time(),
            ],
        ]);
    }

    public function safeDown()
    {
        $this->delete('user', ['username' => ['admin', 'user']]);
    }
}
