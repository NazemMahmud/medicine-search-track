<?php

namespace App\Repositories\UserMed;

use App\Models\Medicines;
use App\Models\UsersMedication;

interface UsersMedicationRepositoryContract
{
    public function findMedicineByRxcui(string $rxcui): Medicines;

    public function addMedication(int $userId, int $medicineId): UsersMedication;
}
