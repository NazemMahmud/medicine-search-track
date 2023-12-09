<?php

namespace App\Repositories\UserMed;

use App\Models\Medicines;
use App\Models\User;
use App\Models\UsersMedication;
use Illuminate\Contracts\Auth\Authenticatable;

interface UsersMedicationRepositoryContract
{
    public function findMedicineByRxcui(string $rxcui): Medicines|null;

    public function addMedication(int $userId, int $medicineId): UsersMedication;

    public function getMedications(User $user): object;

    public function findMedication(Authenticatable $user, string $rxcui): object|null;

    public function delete(int $userId, int $medicineId): void;
}
