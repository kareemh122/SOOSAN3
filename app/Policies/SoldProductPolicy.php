<?php

namespace App\Policies;

use App\Models\SoldProduct;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SoldProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can void the warranty for the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SoldProduct  $soldProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function voidWarranty(User $user, SoldProduct $soldProduct)
    {
        // Allow if the user is an admin or a verified employee
        return $user->isAdmin() || ($user->isEmployee() && $user->is_verified);
    }
}
