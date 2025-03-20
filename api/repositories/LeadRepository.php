<?php

namespace app\repositories;

use app\models\LeadModel;

class LeadRepository
{
    /**
     * @param LeadModel $lead
     * @return bool
     */
    public function save(LeadModel $lead): bool
    {
        return $lead->save();
    }
}