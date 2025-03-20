<?php

namespace app\repositories;

use app\models\LeadModel;
use yii\data\ActiveDataProvider;

class LeadRepository
{
    /**
     * @param array $filters
     * @return ActiveDataProvider
     */
    public function getFilteredLeads(array $filters): ActiveDataProvider
    {
        $query = LeadModel::find();

        if (isset($filters['status'])) {
            $query->andWhere(['status' => $filters['status']]);
        }
        if (isset($filters['created_at'])) {
            $query->andWhere(['>=', 'created_at', $filters['created_at']]);
        }
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
            ],
        ]);
    }

    /**
     * @param int $id
     * @return LeadModel|null
     */
    public function findById(int $id): ?LeadModel
    {
        return LeadModel::findOne($id);
    }

    /**
     * @param LeadModel $lead
     * @return bool
     */
    public function update(LeadModel $lead): bool
    {
        return $lead->update(false);
    }

    /**
     * @param LeadModel $lead
     * @return bool
     */
    public function save(LeadModel $lead): bool
    {
        return $lead->save();
    }
}