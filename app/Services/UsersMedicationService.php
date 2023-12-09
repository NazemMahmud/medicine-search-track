<?php

namespace App\Services;

use App\Repositories\UserMed\UsersMedicationRepositoryContract;

class UsersMedicationService
{
    public function __construct(protected UsersMedicationRepositoryContract $userMedRepo)
    {
    }

    public function addMedication(int $userId, string $rxcui): bool
    {
        if ($medicine = $this->userMedRepo->findMedicineByRxcui($rxcui)) {
            $this->userMedRepo->addMedication($userId, $medicine->id);
            return true;
        }

        return false;
    }
}
