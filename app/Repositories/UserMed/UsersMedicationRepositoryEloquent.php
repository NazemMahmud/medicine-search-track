<?php

namespace App\Repositories\UserMed;


use App\Models\Medicines;
use App\Models\User;
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

    public function getMedications(User $user): object
    {
        return $user->medications->map(function ($medication) {
            return [
                'rxcui' => $medication->rxcui,
                'name' => $medication->name,
                'base_names' => json_decode($medication->base_names),
                'dose_form_group_names' =>  json_decode($medication->dose_form_group_names)
            ];
        });
    }
}
