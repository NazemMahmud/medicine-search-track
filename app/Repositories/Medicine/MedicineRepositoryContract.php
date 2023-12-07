<?php

namespace App\Repositories\Medicine;

interface MedicineRepositoryContract {
    public function saveDrugs(array $data): mixed;
}
