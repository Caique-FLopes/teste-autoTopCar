<?php
use Migrations\AbstractMigration;

class Marcas extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {

        $table = $this->table('marcas', ['engine' => 'InnoDB']);

        $table->addColumn('name', 'string', ['limit' => 100, 'null' => false]);

        $table->addColumn('logo_file', 'string', ['limit' => 150, 'null' => true]);
        $table->addTimestamps('created', 'modified');

        $table->create();

    }
}

