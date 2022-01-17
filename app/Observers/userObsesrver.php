<?php

namespace App\Observers;

use App\User;

class userObsesrver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->userState()->create();
    }

}
