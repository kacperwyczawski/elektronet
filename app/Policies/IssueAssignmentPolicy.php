<?php

namespace App\Policies;

use App\Models\IssueAssignment;
use App\Models\User;

class IssueAssignmentPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role == 'Dyrektor' || $user->role == 'Kierownik') {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, IssueAssignment $issueAssignment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, IssueAssignment $issueAssignment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, IssueAssignment $issueAssignment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, IssueAssignment $issueAssignment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, IssueAssignment $issueAssignment): bool
    {
        return false;
    }
}
