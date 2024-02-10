<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function deleted(User $user)
    {
        $user->update([
	        'email' => time() . '::' . $user->email
	    ]);
    }
}
