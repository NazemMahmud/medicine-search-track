<?php

namespace Tests\Unit;

use App\Helpers\Constants;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class AddMedicationTest extends TestCase
{
    /** API URL for store a new IP address */
    private string $baseUrl;

    /** Authentication token */
    private string $token;

    /** Test data for: successfully add mediation to user */
    private array $successData;

    /** Test data for: missing field value */
    private array $missingData;

    /** Test data for: data type mismatch for field value */
    private array $wrongDataType;

    /** Test data for: rxcui data not found in national library DB */
    private array $invalidData;

    /**
     * Pre-set test data before test methods call
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->token = Redis::get('test_access_token');

        $this->baseUrl = env('APP_URL') . '/api/user/add-medicine';

        $this->missingData = [
            'rxcui' => '',
        ];

        $this->wrongDataType = [
            'rxcui' => 997484,
        ];

        $this->invalidData = [
            'rxcui' => '121'
        ];

        $this->successData = [
            'rxcui' => '997484',
        ];
    }

    /**
     * Test 1: Unauthenticated user/ Token invalid
     */
    public function test_invalid_token()
    {
        $response = $this->postJson($this->baseUrl, $this->successData);
        $response->assertStatus(404)
            ->assertJsonStructure(['error', 'status'])
            ->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', Constants::TOKEN_NOT_FOUND);
    }

    /**
     * Test 2: validation error: missing rxcui value
     */
    public function test_value_missing()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->postJson($this->baseUrl, $this->missingData);

        $response->assertJsonStructure(['error', 'status'])
            ->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', 'rxcui field is missing.');

    }

    /**
     * Test 3: validation error: type mismatch for rxcui
     */
    public function test_data_type_mismatch()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->postJson($this->baseUrl, $this->wrongDataType);

        $response->assertJsonStructure(['error', 'status'])
            ->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', 'rxcui value must be a string.');
    }

    /**
     * Test 4: invalid rxcui from library DB
     */
    public function test_invalid_data()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->postJson($this->baseUrl, $this->invalidData);

        $response->assertStatus(404)
            ->assertJsonStructure(['error', 'status'])
            ->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', 'This is not a valid medicine');
    }

    /**
     * Test 5: successfully added
     */
    public function test_success_search()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->postJson($this->baseUrl, $this->successData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => ['message'],
                'status'
            ])
            ->assertJsonPath('status', Constants::SUCCESS)
            ->assertJsonPath('data.message', 'Medication is added for the user');
    }

    /**
     * Test 6: already added todo: later will use cache instead of DB
     */
    public function test_already_added()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->postJson($this->baseUrl, $this->successData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['message'],
                'status'
            ])
            ->assertJsonPath('status', Constants::SUCCESS)
            ->assertJsonPath('data.message', 'This medication is already added for this user');
    }
}
