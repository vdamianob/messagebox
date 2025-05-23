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
        //per adesso disabilitato per default. DOvrebbe essere che:
        //nessuno può modificare i messaggi, a parte gli admin/superadmin, ma solo determinati campi come:
        //deleted e status.
        
        //vecchia regola: solo l'utente proprietario del messaggio poteva modificarlo
        // return $message->sender_id === $user->getIdentifier();

        //regola attuale: nessuno può modificare il messaggio
        return false;
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
        if ($message->sender_id === $user->getIdentifier()) {
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
        if ($message->sender_id === $user->getIdentifier()) {
            return true;
        }

        // Se l'utente è il destinatario
        if ($message->receiver_id === $user->getIdentifier()) {
            return true;
        }

        // Altrimenti, accesso negato
        return false;
    }
}
