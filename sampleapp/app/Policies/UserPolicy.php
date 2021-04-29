<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Request;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Request $request): bool
    {
        return $user->id === $request->user_id;
    }

    public function destroy(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
