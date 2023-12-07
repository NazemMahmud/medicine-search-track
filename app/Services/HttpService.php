<?php

namespace App\Services;

use GuzzleHttp\Client;

class HttpService
{
    protected Client $client;
    public function __construct()
    {
        $this->client = new Client();
    }

    public function get(string $url)
    {
        $response = $this->client->get($url);
        return json_decode($response->getBody(), true);
    }
}
