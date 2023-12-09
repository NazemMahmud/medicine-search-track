<?php

namespace App\Services;

use App\Repositories\UserMed\UsersMedicationRepositoryContract;

class UsersMedicationService
{
    public function __construct(protected UsersMedicationRepositoryContract $userMedRepo)
    {
    }

// Find the medication ID using the provided rxcui
    public function addMedication(int $userId, string $rxcui): bool
    {

        if ($medicine = $this->userMedRepo->findMedicineByRxcui($rxcui)) {
            // Create a new entry in the users_medications pivot table
            $this->userMedRepo->addMedication($userId, $medicine->id);

            return true;
        }

        return false;
    }
}
