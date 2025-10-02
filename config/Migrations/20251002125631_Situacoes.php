<?php
use Migrations\AbstractMigration;

class Situacoes extends AbstractMigration
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
        
        $table = $this->table('situacoes', ['engine' => 'InnoDB']);
        $table->addColumn('description', 'enum', [
            'values' => ['active', 'deleted'],
            'default' => 'active',
            'null' => false,
        ]);
        $table->addColumn('created_at', 'datetime', [
            'null' => true, 'default' => null
        ]);
        $table->addColumn('updated_at', 'datetime', [
            'null' => true, 'default' => null
        ]);
        $table->create();
    }
}
