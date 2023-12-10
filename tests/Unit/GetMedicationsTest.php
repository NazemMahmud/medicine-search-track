<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Redis;
use Tests\TestCase;
use App\Helpers\Constants;

class GetMedicationsTest extends TestCase
{
    /** API URL for store a new IP address */
    private string $baseUrl;

    /** Authentication token */
    private string $token;

    /**
     * Pre-set test data before test methods call
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->token = Redis::get('test_access_token');

        $this->baseUrl = env('APP_URL') . '/api/user/medicines';
    }

    /**
     * Test 1: Unauthenticated user/ Token invalid
     */
    public function test_invalid_token()
    {
        $response = $this->getJson($this->baseUrl);
        $response->assertStatus(404)
            ->assertJsonStructure(['error', 'status'])
            ->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', Constants::TOKEN_NOT_FOUND);
    }


    /**
     * Test 2: successfully get medication list
     */
    public function test_success_get_medication()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->getJson($this->baseUrl);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'medications' => [
                        '*' => [ 'rxcui','name', 'base_names', 'dose_form_group_names']
                    ]
                ],
                'status'
            ])
            ->assertJsonPath('status', Constants::SUCCESS);
    }
}
