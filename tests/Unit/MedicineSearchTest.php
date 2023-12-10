<?php

namespace Tests\Unit;

use App\Helpers\Constants;
use Tests\TestCase;

class MedicineSearchTest extends TestCase
{
    /** API URL for store a new IP address */
    private string $baseUrl;


    /** Test data for: successfully store a new IP address */
    private string $drugName;

    /**
     * Pre-set test data before test methods call
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->drugName = "Allegra";

        $this->baseUrl = env('APP_URL') . '/api/medicine-search?drug_name=';
    }

    /**
     * Test 1: query param is not sent
     * @return void
     */
    public function test_query_param_unavailable(): void
    {
        $response = $this->getJson($this->baseUrl);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'error',
                'status'
            ])->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', "Drug name is required.");
    }

    /**
     * Test 2: Success
     * @return void
     */
    public function test_success_medicine_search(): void
    {
        $response = $this->getJson($this->baseUrl . $this->drugName);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' =>  [
                    '*' => [
                        'rxcui','name', 'base_names', 'dose_form_group_names'
                    ],
                ],
                'status'
            ])->assertJsonPath('status', Constants::SUCCESS);
    }
}
