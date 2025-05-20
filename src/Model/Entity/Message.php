<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Message Entity
 *
 * @property int $id
 * @property int|null $sender_id
 * @property int|null $receiver_id
 * @property int|null $reply_to_id
 * @property string $status
 * @property bool $read
 * @property string $title
 * @property string $body
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $deleted
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Message $message
 */
class Message extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'sender_id' => true,
        'receiver_id' => true,
        'reply_to_id' => true,
        'status' => true,
        'read' => true,
        'title' => true,
        'body' => true,
        'created' => true,
        'deleted' => true,
        'user' => true,
        'message' => true,
    ];
}
