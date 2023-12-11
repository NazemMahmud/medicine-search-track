<?php

namespace App\Repositories\UserMed;


use App\Models\Medicines;
use App\Models\User;
use App\Models\UsersMedication;
use Illuminate\Contracts\Auth\Authenticatable;

class UsersMedicationRepositoryEloquent implements UsersMedicationRepositoryContract
{
    public function __construct(protected UsersMedication $model)
    {}
    public function findMedicineByRxcui(string $rxcui): Medicines|null
    {
        return Medicines::where('rxcui', $rxcui)->first();
    }

    public function findMedication(Authenticatable $user, string $rxcui): object|null
    {
        return $user->medications()->where('rxcui', $rxcui)->first();
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
        $medications = $user->medications()->whereNull('deleted_at')->get();

        return $medications->map(function ($medication) {
            return [
                'rxcui' => $medication->rxcui,
                'name' => $medication->name,
                'base_names' => json_decode($medication->base_names),
                'dose_form_group_names' =>  json_decode($medication->dose_form_group_names)
            ];
        });
    }

    public function delete(int $userId, int $medicineId): void
    {
        $medication = $this->model::where('user_id', $userId)
            ->where('medication_id', $medicineId)
            ->first();

        $medication->delete();
    }
}
