<?php

namespace app\controllers;

use app\models\LeadModel;
use app\services\LeadService;
use Yii;

class LeadController extends BaseController
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
     * @return LeadModel
     * @throws \Exception
     */
    public function actionSubmit(): LeadModel
    {
        return $this->service->createLead(
            json_decode(Yii::$app->request->getRawBody(), true)
        );
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function actionUpdate(): array
    {
        $data = json_decode(Yii::$app->request->getRawBody(), true);

        if (!isset($data['id'])) {
            return [
                'success' => false,
                'message' => 'Необходимо указать ID заявки',
            ];
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
            'data' => $this->service->updateLead($data['id'], $data['data'])
        ];
    }

    /**
     * @return array
     */
    public function actionList(): array
    {
        $filters = Yii::$app->request->get();
        $dataProvider = $this->service->getFilteredLeads($filters);

        return [
            'success' => true,
            'message' => '',
            'data' => $dataProvider->getModels()
        ];
    }
}