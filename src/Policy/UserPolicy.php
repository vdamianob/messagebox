<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Check if $user can add User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, User $resource)
    {
    }

    /**
     * Check if $user can edit User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
                // Se l'utente è admin
                if ($user->get('role') === 'admin') {
                    return true;
                }
        
                // Se l'utente è lui stesso
                if ($resource->id === $user->getIdentifier()) {
                    return true;
                }
        
                // Altrimenti, accesso negato
                return false;
    }

    /**
     * Check if $user can delete User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        // Se l'utente è admin
        if ($user->get('role') === 'admin') {
            return true;
        }

        // Se l'utente è lui stesso
        if ($resource->id === $user->getIdentifier()) {
            return true;
        }

        // Altrimenti, accesso negato
        return false;
    }

    /**
     * Check if $user can view User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        return true;
    }

    /**
     * Check if $user can change an User password
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource The target resource user.
     * @return bool
     */
    public function canChangePassword(IdentityInterface $user, User $resource)
    {
        // Se l'utente è admin
        if (in_array($user->get('role'), ['admin', 'superadmin'])) {
            return true;
        }

        // Se l'utente è lui stesso
        if ($resource->id === $user->getIdentifier()) {
            return true;
        }

        // Altrimenti, accesso negato
        return false;
    }
}
