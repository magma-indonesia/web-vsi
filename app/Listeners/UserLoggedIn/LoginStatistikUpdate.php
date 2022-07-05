<?php

namespace App\Listeners\UserLoggedIn;

use App\Events\UserLoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginStatistikUpdate
{
    /**
     * Handle the event.
     *
     * @param  UserLoggedIn  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        $event->user->statistik_logins()->updateOrCreate([
            'user_id' => $event->user->id,
            'ip_address' => $event->ip
        ])->increment('hit');
    }
}
