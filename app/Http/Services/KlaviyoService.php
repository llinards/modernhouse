<?php

namespace App\Http\Services;

use KlaviyoAPI\KlaviyoAPI;

class KlaviyoService
{
  private KlaviyoAPI $klaviyo;

  public function __construct()
  {
    $this->klaviyo = new KlaviyoAPI(config('klaviyo.api_key'));
  }

  public function storeProfile(array $request, string $listId, string $source = 'Mājaslapa'): void
  {
    $profileId = $this->upsertProfile($request);
    $this->subscribeProfile($profileId, $listId, $request, $source);
  }

  private function upsertProfile(array $request): string
  {
    $data = [
      'data' => [
        'type'       => 'profile',
        'attributes' => [
          'email'        => $request['email'],
          'phone_number' => $request['phone-number'],
          'first_name'   => $request['first-name'],
          'last_name'    => $request['last-name'],
          'organization' => $request['company'] ?? '',
          'properties'   => [
            'atvertoDurvjuDienasPieteikums' => $request['date-time'] ?? null,
          ],
        ],
      ],
    ];

    $response = $this->klaviyo->Profiles->createOrUpdateProfile($data);

    return $response['data']['id'];
  }

  private function subscribeProfile(string $profileId, string $listId, array $request, string $source): void
  {
    $data = [
      'data' => [
        'type'          => 'profile-subscription-bulk-create-job',
        'attributes'    => [
          'custom_source' => $source,
          'profiles'      => [
            'data' => [
              [
                'type'       => 'profile',
                'id'         => $profileId,
                'attributes' => [
                  'email'         => $request['email'],
                  'phone_number'  => $request['phone-number'],
                  'subscriptions' => [
                    'email' => [
                      'marketing' => [
                        'consent' => 'SUBSCRIBED',
                      ],
                    ],
                  ],
                ],
              ],
            ],
          ],
        ],
        'relationships' => [
          'list' => [
            'data' => [
              'type' => 'list',
              'id'   => $listId,
            ],
          ],
        ],
      ],
    ];

    $this->klaviyo->Profiles->bulkSubscribeProfiles($data);
  }
}
