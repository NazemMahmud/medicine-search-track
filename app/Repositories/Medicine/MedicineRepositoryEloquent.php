<?php

namespace App\Repositories\Medicine;

use App\Exceptions\DatabaseException;
use App\Models\Medicines;
use Illuminate\Support\Facades\Log;
use Exception;

class MedicineRepositoryEloquent implements MedicineRepositoryContract {

    public function __construct(protected Medicines $model)
    {

    }

    /**
     * @param array $data
     * @return array
     * @throws DatabaseException
     */
    public function saveDrugs(array $data): array
    {
        $insertedData = [];
        foreach ($data as $item) {
            try {
                $insert = $this->model::create([
                    'rxcui' => $item['rxcui'],
                    'name' => $item['name'],
                    'drug_name' => $item['drug_name'],
                    'base_names' => json_encode($item['base_names']),
                    'dose_form_group_names' => json_encode($item['dose_form_group_names']),
                ]);

                unset($insert['drug_name']);

                $insertedData[] = $insert;
            } catch (Exception $ex) {
                Log::error("Failed to save entry for rxcui: {$item['rxcui']}. Error: {$ex->getMessage()}");
                throw new DatabaseException('Error saving data to the database.');
            }
        }

        return $insertedData;
    }
}
