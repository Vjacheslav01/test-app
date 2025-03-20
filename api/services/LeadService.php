<?php

namespace app\services;

use app\models\LeadModel;
use app\repositories\LeadRepository;
use Yii;
use yii\data\ActiveDataProvider;

class LeadService
{
    private $repository;

    /**
     * @param LeadRepository $repository
     */
    public function __construct(LeadRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return LeadModel
     * @throws \Exception
     */
    public function createLead(array $data): LeadModel
    {
        $lead = new LeadModel();
        $lead->setAttributes($data);
        $lead->status = LeadModel::STATUS_ACTIVE;

        if (!$this->repository->save($lead)) {
            throw new \Exception('Failed to save request');
        }
        return $lead;
    }

    /**
     * @param int $id
     * @param array $data
     * @return LeadModel
     * @throws \Exception
     */
    public function updateLead(int $id, array $data): LeadModel
    {
        $lead = $this->repository->findById($id);
        if (!$lead) {
            throw new \Exception('Lead not found');
        }

        $lead->setAttributes($data);

        if ($lead->status === LeadModel::STATUS_RESOLVED && empty($request->comment)) {
            throw new \Exception('Comment is required for lead status');
        }

        if (!$this->repository->update($lead)) {
            throw new \Exception('Failed to update lead');
        }

        // Отправка email пользователю
        if ($lead->status === LeadModel::STATUS_RESOLVED) {
            Yii::$app->mailer->compose()
                ->setTo($lead->email)
                ->setSubject('Your lead has been resolved')
                ->setTextBody($lead->comment)
                ->send();
        }

        return $lead;
    }

    /**
     * @param array $filters
     * @return ActiveDataProvider
     */
    public function getFilteredLeads(array $filters): ActiveDataProvider
    {
        return $this->repository->getFilteredLeads($filters);
    }
}