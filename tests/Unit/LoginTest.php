<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Helpers\Constants;

class LoginTest extends TestCase
{
    /** API URL for login */
    private string $loginUrl;

    /** Test data for: form validation error */
    private array $invalidData;

    /** Test data for: validation error for incorrect email */
    private array $emailNotValidatedData;

    /** Test data for: validation errors for incorrect password */
    private array $passwordNotValidatedData;

    /** Test data for: successfully register a new user */
    private array $successRequestData;

    /**
     * Pre-set test data before test methods call
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loginUrl = env('APP_URL') . '/api/login';

        $this->emailNotValidatedData = [
            'email' => 'abc@gmail.com',
            'password' => '123456'
        ];

        $this->passwordNotValidatedData = [
            'email' => 'unittest1@gmail.com',
            'password' => '1234567890'
        ];

        $this->invalidData = [
            'email' => 'unittest1',
            'password' => '123456'
        ];

        $this->successRequestData = [
            'email' => 'unittest1@gmail.com',
            'password' => '123456'
        ];
    }

    /**
     * Test 1: validation error for incorrect email
     * @return void
     */
    public function test_invalid_email(): void
    {
        $response = $this->postJson($this->loginUrl, $this->emailNotValidatedData);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'error',
                'status'
            ])->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', "Invalid email or password");
    }

    /**
     * Test 2: validation errors (multiple) for incorrect password
     * @return void
     */
    public function test_invalid_password(): void
    {
        $response = $this->postJson($this->loginUrl, $this->passwordNotValidatedData);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'error',
                'status'
            ])->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', "Invalid email or password");
    }

    /**
     * Test 3: validation error for incorrect email
     * @return void
     */
    public function test_invalid_form_data(): void
    {
        $response = $this->postJson($this->loginUrl, $this->invalidData);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'error',
                'status'
            ])->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', "The email must be a valid email address.");;
    }

    /**
     * Test 4: successfully register a new user
     * @return void
     */
    public function test_success_login(): void
    {
        $response = $this->postJson($this->loginUrl, $this->successRequestData);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['access_token', 'expires_in'],
                'status'
            ])->assertJsonPath('status', Constants::SUCCESS);
    }
}
