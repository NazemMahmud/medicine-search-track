<?php

namespace App\Repositories\UserMed;

use App\Models\Medicines;
use App\Models\User;
use App\Models\UsersMedication;

interface UsersMedicationRepositoryContract
{
    public function findMedicineByRxcui(string $rxcui): Medicines;

    public function addMedication(int $userId, int $medicineId): UsersMedication;

    public function getMedications(User $user): object;
}
