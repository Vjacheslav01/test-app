<?php

namespace app\components;

use Yii;
use yii\web\User;

class UserComponent extends User
{
    public $identityClass;

    /**
     * @return void
     * @throws \yii\base\InvalidConfigException
     */
    public function init(): void
    {
        parent::init();

        // Получаем токен из заголовка Authorization
        $authHeader = Yii::$app->request->getHeaders()->get('Authorization');
        if ($authHeader !== null && preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches)) {
            // Авторизуем пользователя по auth_key
            $this->loginByAccessToken($matches[1]);
        }
    }
}