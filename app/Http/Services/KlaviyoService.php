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
    return config('app.klaviyo_api_key');
  }

  public function __construct()
  {
    $this->klaviyo = new KlaviyoAPI(
      $this->getApiKey());
  }

  public function subscribeProfile($profileId, $listId, $request)
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
                    'email' => ['MARKETING'],
                    'sms' => ['MARKETING']
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
    }

  }

  public function createProfile($request)
  {
    $data = [
      'data' => [
        'type' => 'profile',
        'attributes' => [
          'email' => $request['email'],
          'phone_number' => $request['phone-number'],
          'first_name' => $request['first-name'],
          'last_name' => $request['last-name'],
          'organization' => $request['company'],
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
        throw new \RuntimeException('Profile not created!');
      }
    }
  }
}
