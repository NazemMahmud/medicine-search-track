<?php

namespace App\Services;

use App\Exceptions\ClientApiException;
use GuzzleHttp\Exception\RequestException;
use Exception;
use Illuminate\Support\Facades\Log;

class MedicineService
{
    protected string $drugName = '';

    /**
     * Fetch drugs information for rxcui and name list
     * @param string $drugName
     * @return array
     * @throws Exception
     */
    public function getDrugs(string $drugName): array
    {
        try {
            $this->drugName = $drugName;
            $client = new HttpService();
            $response = $client->get("https://rxnav.nlm.nih.gov/REST/drugs.json?name=$drugName");

            return $response;
        } catch (RequestException $e) {
            Log::error("Error fetching drug information for $drugName");
            throw new ClientApiException('Error fetching drug information.');
        }
    }

    /**
     * Take n(default 5) items from the drugs search list for tty SBD
     * @param array $drugInfo
     * @param int $limit
     * @return array
     */
    public function extractDrugInfo(array $drugInfo, int $limit = 5): array
    {
        $result = [];
        $count = 0;
        if (isset($drugInfo['drugGroup']['conceptGroup'])) {
            foreach ($drugInfo['drugGroup']['conceptGroup'] as $concept) {
                if (isset($concept['tty']) && $concept['tty'] === 'SBD') {
                    foreach ($concept['conceptProperties'] as $property) {
                        $result[] = [
                            'rxcui' => $property['rxcui'],
                            'name' => $property['name'],
                            'drug_name' => $this->drugName,
                        ];
                        $count++;

                        if($count >= $limit) {
                            break 2;
                        }
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @param array $drugData
     * @return array
     * @throws Exception
     */
    public function getDrugDetails(array $drugData): array
    {
        $result = [];
        $client = new HttpService();

        foreach ($drugData as $drug) {
            try {
                $rxcui = $drug['rxcui'];
                $details = $client->get("https://rxnav.nlm.nih.gov/REST/rxcui/$rxcui/historystatus.json");

                $baseNames = $this->extractBaseNames($details);
                $doseFormGroups = $this->extractDoseFormGroups($details);

                $result[] = [
                    'rxcui' =>$rxcui,
                    'name' => $drug['name'],
                    'drug_name' => $this->drugName,
                    'base_names' => $baseNames,
                    'dose_form_group_names' => $doseFormGroups,
                ];
            } catch (RequestException $e) {
                Log::error("Error fetching details drug information for $this->drugName");
                throw new ClientApiException('Error fetching drug details.');
            }
        }

        return $result;
    }

    /**
     * @param array $details
     * @return array
     */
    private function extractBaseNames(array $details): array
    {
        $baseNames = [];
        if (isset($details['rxcuiStatusHistory']['definitionalFeatures']['ingredientAndStrength'])) {
            foreach ($details['rxcuiStatusHistory']['definitionalFeatures']['ingredientAndStrength'] as $ingredient) {
                $baseNames[] = $ingredient['baseName'];
            }
        }
        return $baseNames;
    }

    /**
     * @param array $details
     * @return array
     */
    private function extractDoseFormGroups(array $details): array
    {
        $doseFormGroups = [];
        if (isset($details['rxcuiStatusHistory']['definitionalFeatures']['doseFormGroupConcept'])) {
            foreach ($details['rxcuiStatusHistory']['definitionalFeatures']['doseFormGroupConcept'] as $doseFormGroup) {
                $doseFormGroups[] = $doseFormGroup['doseFormGroupName'];
            }
        }
        return $doseFormGroups;
    }
}
