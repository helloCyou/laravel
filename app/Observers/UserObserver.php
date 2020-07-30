<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    //
    public function creating(User $user){
        $user->email_token = str_random(10);
        $user->remember_token = str_random(10);
        $user->is_admin = false;
    }
}
