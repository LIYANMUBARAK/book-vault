<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool { return true; } // all users can view

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool  { return true; }
    /**
     * Determine whether the user can create models.
     */
   public function create($user) { return $user->role === 'admin'; }

    /**
     * Determine whether the user can update the model.
     */
 public function update($user, $category) { return $user->role === 'admin'; }


    /**
     * Determine whether the user can delete the model.
     */
 public function delete($user, $category) { return $user->role === 'admin'; }


    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Category $category): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        //
    }
}
