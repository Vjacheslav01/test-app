<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\web\Controller;

class BaseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        // Получаем параметры CORS из конфигурации
        $corsParams = \Yii::$app->params['cors'];

        // Настройка CORS
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => $corsParams['allowedOrigins'],
                'Access-Control-Request-Method' => $corsParams['allowedMethods'],
                'Access-Control-Request-Headers' => $corsParams['allowedHeaders'],
                'Access-Control-Allow-Credentials' => $corsParams['allowedCredentials'],
            ],
        ];
        return $behaviors;
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
       $this->response->format = \yii\web\Response::FORMAT_JSON;
       return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * @return void
     */
    public function actionOptions()
    {
        \Yii::$app->response->statusCode = 200;
    }
}
