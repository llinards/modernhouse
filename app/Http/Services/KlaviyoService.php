<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use KlaviyoAPI\KlaviyoAPI;

class KlaviyoService
{
  public function createProfile($request)
  {
    $klaviyo = new KlaviyoAPI(
      env('KLAVIYO_API_KEY'),
      $num_retries = 3,
      $wait_seconds = 3,
      $guzzle_options = []);
//    $data = array(
//      'data' => array(
//        'type' => 'profile-subscription-bulk-create-job',
//        'attributes' => array(
//          'profiles' => array(
//            'data' => array(
//              array(
//                'type' => 'profile',
//                'id' => '',
//                'attributes' => array(
//                  'email' => $request['email'],
//                  'phone_number' => $request['phone-number'],
//                  'first_name' => $request['first-name'],
//                  'last_name' => $request['last-name'],
//                  'organization' => $request['company'],
//                  'location' => array(
//                    'country' => '',
//                  ),
//                  'subscriptions' => array(
//                    'email' => array(
//                      'MARKETING'
//                    ),
//                    'sms' => array(
//                      'MARKETING'
//                    )
//                  )
//                ),
//              )
//            )
//          )
//        ),
//        'relationships' => array(
//          'list' => array(
//            'data' => array(
//              'type' => 'list',
//              'id' => 'XpkjqM'
//            )
//          )
//        )
//      )
//    );
//
    $data = array(
      'data' => array(
        'type' => 'profile',
        'attributes' => array(
          'email' => $request['email'],
          'phone_number' => $request['phone-number'],
          'first_name' => $request['first-name'],
          'last_name' => $request['last-name'],
          'organization' => $request['company'],
          'location' => array(
            'country' => '',
          )
        )
      )
    );

    $client = new Client();

    $response = $client->request('POST', 'https://a.klaviyo.com/api/profiles/', [
      'body' => json_encode($data, JSON_THROW_ON_ERROR),
      'headers' => [
        'Authorization' => 'Klaviyo-API-Key '.env('KLAVIYO_API_KEY'),
        'accept' => 'application/json',
        'content-type' => 'application/json',
        'revision' => '2023-08-15',
      ],
    ]);

//    $response = $klaviyo->Profiles->createProfile($data);
    return $response;
  }
}
