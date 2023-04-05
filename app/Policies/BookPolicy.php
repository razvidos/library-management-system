<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store(User $user): bool
    {
        return $user !== null;
    }

    public function update(User $user): bool
    {
        return $user !== null;
    }

    public function delete(User $user): bool
    {
        return $user !== null;
    }
}
