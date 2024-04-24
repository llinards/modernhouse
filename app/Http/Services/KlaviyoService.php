<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;
use KlaviyoAPI\ApiException;
use KlaviyoAPI\KlaviyoAPI;

class KlaviyoService
{
  private KlaviyoAPI $klaviyo;

  private function getApiKey()
  {
    return config('klaviyo.api_key');
  }

  public function __construct()
  {
    $this->klaviyo = new KlaviyoAPI(
      $this->getApiKey());
  }

  public function storeProfile($request, $listId): void
  {
    $profileId = $this->createProfile($request);
    if ($profileId) {
      $this->subscribeProfile($profileId, $listId, $request);
    }
  }

  private function subscribeProfile($profileId, $listId, $request): void
  {
    $data = [
      'data' => [
        'type' => 'profile-subscription-bulk-create-job',
        'attributes' => [
          'profiles' => [
            'data' => [
              [
                'type' => 'profile',
                'id' => $profileId,
                'attributes' => [
                  'email' => $request['email'],
                  'phone_number' => $request['phone-number'],
                  'subscriptions' => [
                    'email' => [
                      'marketing' => [
                        'consent' => 'SUBSCRIBED',
                        'consented_at' => date('Y-m-d\TH:i:sO'),
                      ]
                    ],
                    'sms' => [
                      'marketing' => [
                        'consent' => 'SUBSCRIBED',
                        'consented_at' => date('Y-m-d\TH:i:sO'),
                      ]
                    ]
                  ]
                ]
              ]
            ]
          ]
        ],
        'relationships' => [
          'list' => [
            'data' => [
              'type' => 'list',
              'id' => $listId
            ]
          ]
        ]
      ]
    ];
    try {
      $this->klaviyo->Profiles->subscribeProfiles($data);
      Log::info('Profile subscribed!');
    } catch (ApiException $e) {
      Log::error($e->getResponseBody());
      Log::error('Profile subscription failed!');
    }

  }

  private function createProfile($request)
  {
    $data = [
      'data' => [
        'type' => 'profile',
        'attributes' => [
          'email' => $request['email'],
          'phone_number' => $request['phone-number'],
          'first_name' => $request['first-name'],
          'last_name' => $request['last-name'],
          'organization' => $request['company'] ?? '',
        ]
      ]
    ];
    try {
      $response = $this->klaviyo->Profiles->createProfile($data);
      Log::info('Profile created!');
      return $response['data']['id'];
    } catch (ApiException $e) {
      if ($e->getCode() === 409) {
        $profileId = json_decode($e->getResponseBody(), true);
        Log::info('Profile already exists!');
        return $profileId['errors'][0]['meta']['duplicate_profile_id'];
      } else {
        Log::error($e->getResponseBody());
        Log::error('Profile creation failed!');
        throw new \RuntimeException('Profile not created!');
      }
    }
  }
}
