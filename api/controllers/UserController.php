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
        list($defaultData) = [
            [
                'success' => false,
                'error' => true,
                'message' => 'Неверный e-mail или пароль',
                'data' => [],
            ]
        ];

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $defaultData['message'] = 'Вы успешно авторизовались';
            $defaultData['success'] = true;
            $defaultData['error']   = false;
            return $defaultData;
        }
        return $defaultData;
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
