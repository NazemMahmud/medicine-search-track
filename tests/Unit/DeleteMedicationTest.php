<?php

namespace Tests\Unit;

use App\Helpers\Constants;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class DeleteMedicationTest extends TestCase
{
    /** API URL for store a new IP address */
    private string $baseUrl;

    /** Authentication token */
    private string $token;

    /** Test data for: successfully delete medication for a user */
    private string $successData;

    /** Test data for: rxcui data not added for this user */
    private string $notFoundData;

    /** Test data for: rxcui data not found in national library DB */
    private string $invalidData;

    /**
     * Pre-set test data before test methods call
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->token = Redis::get('test_access_token');

        $this->baseUrl = env('APP_URL') . '/api/user/delete-medicine';

        $this->notFoundData = '997485';

        $this->invalidData = '121';

        $this->successData = '997484';
    }

    /**
     * Test 1: Unauthenticated user/ Token invalid
     */
    public function test_invalid_token()
    {
        $response = $this->deleteJson($this->baseUrl . "/$this->notFoundData" );
        $response->assertStatus(404)
            ->assertJsonStructure(['error', 'status'])
            ->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', Constants::TOKEN_NOT_FOUND);
    }


    /**
     * Test 2: invalid rxcui from library DB
     */
    public function test_invalid_data()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->deleteJson($this->baseUrl . "/$this->invalidData");

        $response->assertStatus(404)
            ->assertJsonStructure(['error', 'status'])
            ->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', 'This is not a valid medicine');
    }

    /**
     * Test 3: medicine is not added for this user
     */
    public function test_medicine_not_for_user()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->deleteJson($this->baseUrl . "/$this->notFoundData");

        $response->assertStatus(404)
            ->assertJsonStructure([
                'error',
                'status'
            ])
            ->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', 'Medication not found for this user.');
    }

    /**
     * Test 4: successfully deleted (soft delete)
     */
    public function test_success_soft_delete()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->deleteJson($this->baseUrl . "/$this->successData");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['message'],
                'status'
            ])
            ->assertJsonPath('status', Constants::SUCCESS)
            ->assertJsonPath('data.message', 'Medication removed successfully.');
    }

}
