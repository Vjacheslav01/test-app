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
}