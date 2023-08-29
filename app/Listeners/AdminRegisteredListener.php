<?php

namespace App\Listeners;

use App\Events\AdminRegisteredEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class AdminRegisteredListener
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
    public function handle(AdminRegisteredEvent $event)
    {
        if ($event->admin instanceof MustVerifyEmail && ! $event->admin->hasVerifiedEmail()) {
            $event->admin->sendEmailVerificationNotification();
        }
    }
}
