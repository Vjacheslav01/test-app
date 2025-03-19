<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250319_190542_create_user_table extends Migration
{
    /**
     * @return bool
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey()->comment('ID пользователя'),
            'username' => $this->string()->notNull()->unique()->comment('Имя пользователя'),
            'auth_key' => $this->string(32)->notNull()->comment('Ключ авторизации'),
            'password_hash' => $this->string()->notNull()->comment('Хэш пароля'),
            'password_reset_token' => $this->string()->unique()->comment('Токен сброса пароля'),
            'email' => $this->string()->notNull()->unique()->comment('Электронная почта'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('Статус пользователя'),
            'created_at' => $this->integer()->notNull()->comment('Дата создания'),
            'updated_at' => $this->integer()->notNull()->comment('Дата обновления'),
        ]);
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
