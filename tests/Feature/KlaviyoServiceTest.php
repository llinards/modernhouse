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

describe('storeProfile upserts profile and subscribes', function () {
    it('upserts profile and subscribes to list', function () {
        $this->profilesApi
            ->shouldReceive('createOrUpdateProfile')
            ->once()
            ->andReturn(['data' => ['id' => 'profile-abc']]);

        $this->profilesApi
            ->shouldReceive('bulkSubscribeProfiles')
            ->once()
            ->withArgs(function ($data) {
                return $data['data']['attributes']['custom_source'] === 'Mājaslapa'
                    && $data['data']['relationships']['list']['data']['id'] === $this->testListId
                    && $data['data']['attributes']['profiles']['data'][0]['id'] === 'profile-abc'
                    && $data['data']['attributes']['profiles']['data'][0]['attributes']['email'] === 'janis@example.com'
                    && $data['data']['attributes']['profiles']['data'][0]['attributes']['subscriptions']['email']['marketing']['consent'] === 'SUBSCRIBED'
                    && !isset($data['data']['attributes']['profiles']['data'][0]['attributes']['subscriptions']['sms']);
            });

        $this->service->storeProfile($this->validRequest, $this->testListId);
    });
});

describe('storeProfile lets exceptions propagate', function () {
    it('throws when upsert fails', function () {
        $this->profilesApi
            ->shouldReceive('createOrUpdateProfile')
            ->once()
            ->andThrow(new ApiException('Server Error', 500, [], '{"error":"fail"}'));

        $this->service->storeProfile($this->validRequest, $this->testListId);
    })->throws(ApiException::class);

    it('throws when subscription fails', function () {
        $this->profilesApi
            ->shouldReceive('createOrUpdateProfile')
            ->once()
            ->andReturn(['data' => ['id' => 'profile-abc']]);

        $this->profilesApi
            ->shouldReceive('bulkSubscribeProfiles')
            ->once()
            ->andThrow(new ApiException('Bad Request', 400, [], '{"error":"invalid"}'));

        $this->service->storeProfile($this->validRequest, $this->testListId);
    })->throws(ApiException::class);
});

describe('storeProfile payload structure', function () {
    it('sends correct upsert payload', function () {
        $this->profilesApi
            ->shouldReceive('createOrUpdateProfile')
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

        $this->profilesApi->shouldReceive('bulkSubscribeProfiles')->once();

        $this->service->storeProfile($this->validRequest, $this->testListId);
    });

    it('includes date-time custom property when provided', function () {
        $request = array_merge($this->validRequest, ['date-time' => '18.jūlijs, 10:00']);

        $this->profilesApi
            ->shouldReceive('createOrUpdateProfile')
            ->once()
            ->withArgs(function ($data) {
                return $data['data']['attributes']['properties']['atvertoDurvjuDienasPieteikums'] === '18.jūlijs, 10:00';
            })
            ->andReturn(['data' => ['id' => 'profile-abc']]);

        $this->profilesApi->shouldReceive('bulkSubscribeProfiles')->once();

        $this->service->storeProfile($request, $this->testListId);
    });

    it('defaults company to empty string when missing', function () {
        $request = $this->validRequest;
        unset($request['company']);

        $this->profilesApi
            ->shouldReceive('createOrUpdateProfile')
            ->once()
            ->withArgs(function ($data) {
                return $data['data']['attributes']['organization'] === '';
            })
            ->andReturn(['data' => ['id' => 'profile-abc']]);

        $this->profilesApi->shouldReceive('bulkSubscribeProfiles')->once();

        $this->service->storeProfile($request, $this->testListId);
    });
});
