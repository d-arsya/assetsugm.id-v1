<?php

namespace App\Listeners;

use App\Models\Voter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;

class AfterSendMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        $token = $event->data['token'] ?? null;

        if ($token) {
            Voter::where('code', $token)
                ->update(['sended' => now()]);
        }
    }
}
