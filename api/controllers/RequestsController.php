<?php

namespace app\controllers;

use app\models\LeadModel;
use app\services\LeadService;
use Yii;
use yii\web\HttpException;

class RequestsController extends BaseController
{
    /**
     * @var bool
     */
    public $enableCsrfValidation = false;

    /**
     * @var LeadService
     */
    private $service;

    /**
     * @param $id
     * @param $module
     * @param LeadService $service
     * @param $config
     */
    public function __construct($id, $module, LeadService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @return array[]
     */
    public function actions()
    {
        return [
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    /**
     * @return LeadModel
     * @throws \Exception
     */
    public function actionSubmit(): ?LeadModel
    {
        $data = json_decode(Yii::$app->request->getRawBody(), true);

        if (isset($data['name']) && isset($data['email']) && isset($data['message'])) {
            return $this->service->createLead(
                $data
            );
        }
        throw new HttpException(400, 'Invalid request body');
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function actionUpdate($id): array
    {
        $data = json_decode(Yii::$app->request->getRawBody(), true);

        if (!Yii::$app->user->isGuest) {
            if (!isset($data['comment'])) {
                throw new HttpException(400, 'Invalid request body');
            }
            if (!Yii::$app->user->can('admin')) {
                return [
                    'success' => false,
                    'message' => 'Не достаточно привилегии для данной операции',
                ];
            }
            return [
                'success' => true,
                'message' => 'Updated successfully',
                'data' => $this->service->updateLead($id, $data)
            ];
        }
        throw new HttpException(403, 'Access denied');
    }

    /**
     * @return array
     */
    public function actionList(): array
    {
        if (!Yii::$app->user->isGuest) {
            $filters = Yii::$app->request->get();
            $dataProvider = $this->service->getFilteredLeads($filters);
            return [
                'success' => true,
                'message' => '',
                'data' => $dataProvider->getModels()
            ];
        }
        throw new HttpException(403, 'Access denied');
    }
}