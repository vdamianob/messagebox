<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Message;
use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * Message policy
 */
class MessagePolicy
{
    /**
     * Check if $user can add Message
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Message $message
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Message $message)
    {
        return true;
    }

    /**
     * Check if $user can edit Message
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Message $message
     * @return bool
     */

    public function canEdit(IdentityInterface $user, Message $message)
    {
        return $message->sender === $user->getIdentifier();
    }

    /**
     * Check if $user can delete Message
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Message $message
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Message $message)
    {
        // Se l'utente è admin
        if ($user->get('role') === 'admin') {
            return true;
        }

        // Se l'utente è il mittente
        if ($message->sender === $user->getIdentifier()) {
            return true;
        }

        // Altrimenti, accesso negato
        return false;
    }

    /**
     * Check if $user can view Message
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Message $message
     * @return bool
     */
    public function canView(IdentityInterface $user, Message $message)
    {
        // Se l'utente è admin
        if ($user->get('role') === 'admin') {
            return true;
        }

        // Se l'utente è il mittente
        if ($message->sender === $user->getIdentifier()) {
            return true;
        }

        // Se l'utente è il destinatario
        if ($message->receiver === $user->getIdentifier()) {
            return true;
        }

        // Altrimenti, accesso negato
        return false;
    }
}
