<?php

namespace App\Chanels;

use App\Services\GetFirebaseAccessToken;
use Exception;
use Google\Client;
use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FirebaseSMSChanel
{
    protected $firebaseProjectId;
    protected $client;
    protected $getFirebaseAccessToken;

    public function __construct(Client $client, GetFirebaseAccessToken $getFirebaseAccessToken)
    {
        $this->firebaseProjectId = env("FIREBASE_PROJECT_ID");
        $this->client = $client;
        $this->getFirebaseAccessToken = $getFirebaseAccessToken;
    }


    public function send(object $notifiable, Notification $notification): bool
    {
        $messageObj = $notification->toFirebaseSMS();
        $message = $messageObj->getMessage();
        $title = $messageObj->getTitle();
        $fcmDeviceToken = $notifiable->fcm_device_token;

        try {

            return $this->sendFirebaseNotification($fcmDeviceToken, $title, $message);
        
        } catch (Exception $ex) {
            Log::info('Firebase Sending Message Failed: ' . $ex->getMessage());
            return false;
        }
    }

    public function sendFirebaseNotification($fcmDeviceToken, $title, $message): bool
    {
        $data = $this->getData($fcmDeviceToken, $title, $message);  
        
        $url = 'https://fcm.googleapis.com/v1/projects/' . $this->firebaseProjectId . '/messages:send';

        // Send request using Http facade
        $response = Http::withToken($this->getFirebaseAccessToken->getAccessToken())
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->withoutVerifying()
            ->post($url, $data);

        return $response->successful();

    }

    private function getData($fcmDeviceToken, $title, $message)
    {
        $data = [
            "message" => [
                "token" => $fcmDeviceToken, // Single device token. For multiple tokens, you need to use `batch send` method.
                "notification" => [
                    "title" => $title,
                    "body" => $message,
                ],
                "android" => [
                    "priority" => "high",
                    "notification" => [
                        "sound" => "default",
                    ],
                ],
                "apns" => [
                    "payload" => [
                        "aps" => [
                            "sound" => "default",
                        ],
                    ],
                ],
            ],
        ];

        return $data;
    }
}