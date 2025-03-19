<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;

class UserController extends BaseController
{
    /**
     * @var bool
     */
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * @return array
     */
    public function actionAuth(): array
    {
        list($response, $model) = [
            [
                'success' => false,
                'error' => true,
                'message' => 'Неверный e-mail или пароль',
                'data' => [],
            ],
            new LoginForm(
                json_decode(Yii::$app->request->getRawBody(), true)
            )
        ];
        if ($model->login()) {
            $response['message'] = 'Вы успешно авторизовались';
            $response['success'] = true;
            $response['error']   = false;
            return $response;
        }
        return $response;
    }

    /**
     * @return array
     */
    public function actionLogout(): array
    {
        list($defaultData) = [
            [
                'success' => false,
                'error' => true,
                'message' => 'Не удалось выйти из системы',
                'data' => [],
            ]
        ];
        if (Yii::$app->user->logout()) {
            $defaultData['success'] = true;
            $defaultData['error']   = false;
            $defaultData['message'] = 'Вы вышли из системы';
            return $defaultData;
        }
        return $defaultData;
    }
}
