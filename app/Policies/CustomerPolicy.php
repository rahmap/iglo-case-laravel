<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\User;

class CustomerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::AccountOpeningsAccess);
    }
}
