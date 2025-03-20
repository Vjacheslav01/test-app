<?php

declare(strict_types=1);

namespace app\models;

use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Модель пользователя.
 *
 * @property int $id Уникальный идентификатор пользователя
 * @property string $username Имя пользователя
 * @property string $auth_key Ключ авторизации
 * @property string $password_hash Хэш пароля
 * @property string|null $password_reset_token Токен сброса пароля
 * @property string $email Электронная почта
 * @property int $status Статус пользователя
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id): ?self
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findByEmail($email): ?self
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null): ?self
    {
        return static::findOne(['auth_key' => $token]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Проверяет пароль.
     *
     * @param string $password Пароль для проверки
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Устанавливает пароль.
     * @param string $password Пароль для установки
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Генерирует ключ авторизации.
     */
    public function generateAuthKey(): void
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }
}