<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Helpers\Constants;

class RegistrationTest extends TestCase
{
    /** API URL for registration */
    private string $registrationUrl;

    /** Test data for: validation error for incorrect name */
    private array $nameNotValidatedData;

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

        $this->registrationUrl = env('APP_URL') . '/api/register';

        $this->nameNotValidatedData = [
            'name' => '',
            'email' => 'unittest1@gmail.com',
            'password' => '123456'
        ];

        $this->emailNotValidatedData = [
            'name' => 'Unit Test User 1',
            'email' => 'unittest1',
            'password' => '123456',
        ];

        $this->passwordNotValidatedData = [
            'name' => 'Unit Test User 1',
            'email' => 'unittest1@gmail.com',
            'password' => '123'
        ];

        $this->successRequestData = [
            'name' => 'Unit Test User 1',
            'email' => 'unittest1@gmail.com',
            'password' => '123456'
        ];
    }

    /**
     * Test 1: validation error for incorrect name
     * @return void
     */
    public function test_name_not_validated(): void
    {
        $response = $this->postJson($this->registrationUrl, $this->nameNotValidatedData);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'error',
                'status'
            ])->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', "The name field is required.");
    }

    /**
     * Test 2: validation error for incorrect email
     * @return void
     */
    public function test_email_not_validated(): void
    {
        $response = $this->postJson($this->registrationUrl, $this->emailNotValidatedData);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'error',
                'status'
            ])->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error',  "The email must be a valid email address.");
    }

    /**
     * Test 3: validation errors (multiple) for incorrect password
     * @return void
     */
    public function test_password_not_validated(): void
    {
        $response = $this->postJson($this->registrationUrl, $this->passwordNotValidatedData);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'error',
                'status'
            ])->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', "The password must be at least 6 characters.");
    }

    /**
     * Test 4: successfully register a new user
     * @return void
     */
    public function test_success_registration(): void
    {
        $response = $this->postJson($this->registrationUrl, $this->successRequestData);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [ 'message'],
                'status'
            ])->assertJsonPath('status', Constants::SUCCESS)
            ->assertJsonPath('data.message', 'Registration done successfully.');
    }

    /**
     * Test 5: duplicate email error test
     * @return void
     */
    public function test_duplicate_email_error(): void
    {
        $response = $this->postJson($this->registrationUrl, $this->successRequestData);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'error',
                'status'
            ])->assertJsonPath('status', Constants::FAILED)
            ->assertJsonPath('error', "The email has already been taken.");
    }
}
