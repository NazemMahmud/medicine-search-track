<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

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

        $this->token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjU5NDMxODYzLCJleHAiOjE2NTk0MzU0NjMsIm5iZiI6MTY1OTQzMTg2MywianRpIjoiUXVsODJ0YTgxUTdQV1dtNiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3IiwicGF5bG9hZCI6eyJpZCI6MSwibmFtZSI6IlVuaXQgVGVzdCBVc2VyIDEifX0.sNV-eKSVwN4L5ZUFF_InnD4b6a3M6UUkM603_vPKg-A';

        $this->baseUrl = env('APP_URL') . '/api/';

        $this->invalidData = [
            'label' => ''
        ];

        $this->successRequestData = [
            'label' => 'test.site.1'
        ];
    }
}
