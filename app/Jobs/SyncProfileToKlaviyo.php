<?php

namespace App\Jobs;

use App\Http\Services\KlaviyoService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SyncProfileToKlaviyo implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    /** @var int[] */
    public array $backoff = [10, 30, 60];

    public function __construct(
        public array $profileData,
        public string $listId,
        public string $source = 'Mājaslapa',
    ) {}

    public function handle(KlaviyoService $klaviyoService): void
    {
        $klaviyoService->storeProfile($this->profileData, $this->listId, $this->source);
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('Klaviyo sync failed permanently for profile: '.($this->profileData['email'] ?? 'unknown'), [
            'listId'    => $this->listId,
            'exception' => $exception->getMessage(),
        ]);
    }
}
