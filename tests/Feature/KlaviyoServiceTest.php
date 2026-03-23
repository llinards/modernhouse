<?php

use App\Http\Services\KlaviyoService;
use KlaviyoAPI\ApiException;
use KlaviyoAPI\KlaviyoAPI;

beforeEach(function () {
    $this->profilesApi = Mockery::mock();
    $this->klaviyoApi = Mockery::mock(KlaviyoAPI::class)->makePartial();
    $this->klaviyoApi->Profiles = $this->profilesApi;

    $this->service = new KlaviyoService();
    $reflection = new ReflectionProperty(KlaviyoService::class, 'klaviyo');
    $reflection->setAccessible(true);
    $reflection->setValue($this->service, $this->klaviyoApi);

    $this->validRequest = [
        'email'        => 'janis@example.com',
        'phone-number' => '+37120000000',
        'first-name'   => 'Jānis',
        'last-name'    => 'Bērziņš',
        'company'      => 'SIA Tests',
    ];

    $this->testListId = 'test-list-123';
});

describe('storeProfile creates new profile and subscribes', function () {
    it('creates profile and subscribes to list', function () {
        $this->profilesApi
            ->shouldReceive('createProfile')
            ->once()
            ->andReturn(['data' => ['id' => 'profile-abc']]);

        $this->profilesApi
            ->shouldReceive('subscribeProfiles')
            ->once()
            ->withArgs(function ($data) {
                return $data['data']['relationships']['list']['data']['id'] === $this->testListId
                    && $data['data']['attributes']['profiles']['data'][0]['id'] === 'profile-abc'
                    && $data['data']['attributes']['profiles']['data'][0]['attributes']['email'] === 'janis@example.com'
                    && $data['data']['attributes']['profiles']['data'][0]['attributes']['subscriptions']['email']['marketing']['consent'] === 'SUBSCRIBED'
                    && !isset($data['data']['attributes']['profiles']['data'][0]['attributes']['subscriptions']['email']['marketing']['consented_at'])
                    && $data['data']['attributes']['profiles']['data'][0]['attributes']['subscriptions']['sms']['marketing']['consent'] === 'SUBSCRIBED'
                    && !isset($data['data']['attributes']['profiles']['data'][0]['attributes']['subscriptions']['sms']['marketing']['consented_at']);
            });

        $this->service->storeProfile($this->validRequest, $this->testListId);
    });

    it('does not call updateProfile for new profiles', function () {
        $this->profilesApi
            ->shouldReceive('createProfile')
            ->once()
            ->andReturn(['data' => ['id' => 'profile-abc']]);

        $this->profilesApi
            ->shouldReceive('subscribeProfiles')
            ->once();

        $this->profilesApi
            ->shouldNotReceive('updateProfile');

        $this->service->storeProfile($this->validRequest, $this->testListId);
    });
});

describe('storeProfile handles existing profile (409)', function () {
    it('updates existing profile and subscribes', function () {
        $existingProfileId = 'existing-profile-xyz';
        $apiException = new ApiException(
            'Conflict',
            409,
            [],
            json_encode([
                'errors' => [
                    ['meta' => ['duplicate_profile_id' => $existingProfileId]],
                ],
            ])
        );

        $this->profilesApi
            ->shouldReceive('createProfile')
            ->once()
            ->andThrow($apiException);

        $this->profilesApi
            ->shouldReceive('updateProfile')
            ->once()
            ->withArgs(function ($profileId, $data) use ($existingProfileId) {
                return $profileId === $existingProfileId
                    && $data['data']['id'] === $existingProfileId
                    && $data['data']['attributes']['first_name'] === 'Jānis'
                    && $data['data']['attributes']['last_name'] === 'Bērziņš'
                    && $data['data']['attributes']['organization'] === 'SIA Tests';
            });

        $this->profilesApi
            ->shouldReceive('subscribeProfiles')
            ->once()
            ->withArgs(function ($data) use ($existingProfileId) {
                return $data['data']['attributes']['profiles']['data'][0]['id'] === $existingProfileId;
            });

        $this->service->storeProfile($this->validRequest, $this->testListId);
    });
});

describe('storeProfile handles non-409 API errors', function () {
    it('throws RuntimeException on non-409 error', function () {
        $apiException = new ApiException(
            'Server Error',
            500,
            [],
            json_encode(['error' => 'Internal server error'])
        );

        $this->profilesApi
            ->shouldReceive('createProfile')
            ->once()
            ->andThrow($apiException);

        $this->service->storeProfile($this->validRequest, $this->testListId);
    })->throws(RuntimeException::class, 'Profile not created!');
});

describe('storeProfile payload structure', function () {
    it('sends correct create profile payload', function () {
        $this->profilesApi
            ->shouldReceive('createProfile')
            ->once()
            ->withArgs(function ($data) {
                $attrs = $data['data']['attributes'];

                return $data['data']['type'] === 'profile'
                    && $attrs['email'] === 'janis@example.com'
                    && $attrs['phone_number'] === '+37120000000'
                    && $attrs['first_name'] === 'Jānis'
                    && $attrs['last_name'] === 'Bērziņš'
                    && $attrs['organization'] === 'SIA Tests'
                    && $attrs['properties']['atvertoDurvjuDienasPieteikums'] === null;
            })
            ->andReturn(['data' => ['id' => 'profile-abc']]);

        $this->profilesApi->shouldReceive('subscribeProfiles')->once();

        $this->service->storeProfile($this->validRequest, $this->testListId);
    });

    it('includes date-time custom property when provided', function () {
        $request = array_merge($this->validRequest, ['date-time' => '18.jūlijs, 10:00']);

        $this->profilesApi
            ->shouldReceive('createProfile')
            ->once()
            ->withArgs(function ($data) {
                return $data['data']['attributes']['properties']['atvertoDurvjuDienasPieteikums'] === '18.jūlijs, 10:00';
            })
            ->andReturn(['data' => ['id' => 'profile-abc']]);

        $this->profilesApi->shouldReceive('subscribeProfiles')->once();

        $this->service->storeProfile($request, $this->testListId);
    });

    it('defaults company to empty string when missing', function () {
        $request = $this->validRequest;
        unset($request['company']);

        $this->profilesApi
            ->shouldReceive('createProfile')
            ->once()
            ->withArgs(function ($data) {
                return $data['data']['attributes']['organization'] === '';
            })
            ->andReturn(['data' => ['id' => 'profile-abc']]);

        $this->profilesApi->shouldReceive('subscribeProfiles')->once();

        $this->service->storeProfile($request, $this->testListId);
    });
});
