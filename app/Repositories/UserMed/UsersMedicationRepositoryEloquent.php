<?php

namespace App\Repositories\UserMed;


use App\Models\Medicines;
use App\Models\UsersMedication;

class UsersMedicationRepositoryEloquent implements UsersMedicationRepositoryContract
{
    public function findMedicineByRxcui(string $rxcui): Medicines
    {
        return Medicines::where('rxcui', $rxcui)->first();
    }

    public function addMedication(int $userId, int $medicineId): UsersMedication
    {
        $res = UsersMedication::create([
            'user_id' => $userId,
            'medication_id' => $medicineId
        ]);

        return $res;
    }
}
