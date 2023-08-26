<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;
use KlaviyoAPI\ApiException;
use KlaviyoAPI\KlaviyoAPI;

class KlaviyoService
{
  private KlaviyoAPI $klaviyo;

  public function __construct()
  {
    $this->klaviyo = new KlaviyoAPI(
      env('KLAVIYO_API_KEY'),
      $num_retries = 3,
      $wait_seconds = 3,
      $guzzle_options = []);
  }

  public function subscribeToList($profileId, $listId, $request)
  {
    $data = array(
      'data' => array(
        'type' => 'profile-subscription-bulk-create-job',
        'attributes' => array(
          'profiles' => array(
            'data' => array(
              array(
                'type' => 'profile',
                'id' => $profileId,
                'attributes' => array(
                  'email' => $request['email'],
                  'phone_number' => $request['phone-number'],
                  'subscriptions' => array(
                    'email' => array(
                      'MARKETING'
                    ),
                    'sms' => array(
                      'MARKETING'
                    )
                  )
                ),
              )
            )
          )
        ),
        'relationships' => array(
          'list' => array(
            'data' => array(
              'type' => 'list',
              'id' => $listId
            )
          )
        )
      )
    );

    try {
      $response = $this->klaviyo->Profiles->subscribeProfiles($data);
      dd($response);
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
      return $response['data']['id'];
    } catch (ApiException $e) {
      Log::error($e->getResponseBody());
    }
  }
}
