<?php

namespace App\Listeners\UserLoggedIn;

use App\Events\UserLoggedIn;

class LoginStatisticUpdate
{
    /**
     * Handle the event.
     *
     * @param UserLoggedIn $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        $event->user->loginStatistic()->updateOrCreate([
            'user_id' => $event->user->id,
            'ip_address' => $event->ip
        ])->increment('hit');
    }
}
