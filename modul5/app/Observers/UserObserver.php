<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if (! $user->wasChanged('role')) {
            return;
        }

        // Mencatat target, role lama, role baru, dan aktor.
        Log::info('user.role.changed', [
            'target_user_id' => $user->id,
            'old_role'       => $user->getRawOriginal('role'),
            'new_role'       => $user->role,
            'actor_id'       => Auth::id(),
        ]);
    }
}
