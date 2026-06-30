<?php

namespace App\Mail\Concerns;

use Illuminate\Support\Facades\Log;
use Throwable;

trait LogsMailFailures
{
    /**
     * Handle a failure of the queued mailable.
     *
     * Invoked by the queue worker when the mailable's job exhausts its
     * retries, so delivery problems surface in the logs instead of only
     * landing silently in the failed_jobs table.
     */
    public function failed(Throwable $exception): void
    {
        Log::error('Failed to send '.class_basename($this).' email.', [
            'mailable'   => static::class,
            'recipients' => collect($this->to)->pluck('address')->all(),
            'exception'  => $exception->getMessage(),
        ]);
    }
}
