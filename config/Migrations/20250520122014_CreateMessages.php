<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMessages extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
$table = $this->table('messages');

        $table->addColumn('sender_id', 'integer', [
            'null' => true,
            'default' => null,
        ]);
        $table->addColumn('receiver_id', 'integer', [
            'null' => true,
            'default' => null,
        ]);
        $table->addColumn('reply_to_id', 'integer', [
            'null' => true,
            'default' => null,
        ]);
        $table->addColumn('status', 'enum', [
            'values' => ['disabled', 'active'],
            'default' => 'active',
            'null' => false,
        ]);
        $table->addColumn('read', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'null' => false,
            'limit' => 255,
        ]);
        $table->addColumn('body', 'text', [
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => false,
            'default' => 'CURRENT_TIMESTAMP',
        ]);
        $table->addColumn('deleted', 'datetime', [
            'null' => true,
            'default' => null,
        ]);

        // Creo la tabella con chiave primaria autoincrementata (default)
        $table->create();

        // Aggiungo le foreign key dopo la creazione per gestire on delete set null
        $this->table('messages')
            ->addForeignKey('sender_id', 'users', 'id', [
                'delete'=> 'SET_NULL',
                'update'=> 'NO_ACTION',
            ])
            ->addForeignKey('receiver_id', 'users', 'id', [
                'delete'=> 'SET_NULL',
                'update'=> 'NO_ACTION',
            ])
            ->addForeignKey('reply_to_id', 'messages', 'id', [
                'delete'=> 'SET_NULL',
                'update'=> 'NO_ACTION',
            ])
            ->update();
    }
}
