<?php

namespace app\services;

use app\models\LeadModel;
use app\repositories\LeadRepository;

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
}