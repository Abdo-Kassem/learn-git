<?php

namespace App\Services;

use Google\Client;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Support\Facades\Cache;

class GetFirebaseAccessToken
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->client->setAuthConfig(storage_path('framework/firebase.json'));
        $this->client->addScope(['https://www.googleapis.com/auth/firebase.messaging']);
    }


    public function getAccessToken()
    {
        return Cache::remember('firebase_access_token', 3600, function() {
            
            if ($this->client->isAccessTokenExpired()) {
                $this->client->fetchAccessTokenWithAssertion(new GuzzleHttpClient([
                    'verify' => false,
                ]));
            }
    
            return $this->client->getAccessToken()['access_token'];
        });
    }
}