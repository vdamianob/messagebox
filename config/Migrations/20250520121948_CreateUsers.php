<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users');

        $table->addColumn('email', 'string', [
            'null' => false,
            'limit' => 255,
        ]);
        $table->addColumn('password', 'string', [
            'null' => false,
            'limit' => 255,
        ]);
        $table->addColumn('role', 'enum', [
            'values' => ['guest', 'user', 'admin', 'superadmin'],
            'default' => 'user',
            'null' => false,
        ]);
        $table->addColumn('status', 'enum', [
            'values' => ['disabled', 'active'],
            'default' => 'active',
            'null' => false,
        ]);
        $table->addColumn('username', 'string', [
            'null' => false,
            'limit' => 255,
        ]);
        $table->addColumn('avatar_img_path', 'string', [
            'null' => false,
            'default' => 'user.jpg',
            'limit' => 255,
        ]);
        $table->addColumn('note', 'text', [
            'null' => true,
            'default' => null,
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => false,
            'default' => 'CURRENT_TIMESTAMP',
        ]);
        $table->addColumn('modified', 'datetime', [
            'null' => true,
            'default' => null,
        ]);
        $table->addColumn('last_login', 'datetime', [
            'null' => false,
            'default' => 'CURRENT_TIMESTAMP',
        ]);
        $table->addColumn('deleted', 'datetime', [
            'null' => true,
            'default' => null,
        ]);

        $table->addIndex(['email'], ['unique' => true]);
        $table->addIndex(['username'], ['unique' => true]);

        $table->create();
    }
}
