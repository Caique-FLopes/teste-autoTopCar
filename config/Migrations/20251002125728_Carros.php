<?php
use Migrations\AbstractMigration;

class Carros extends AbstractMigration
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
        $table = $this->table('carros', ['engine' => 'InnoDB']);

        $table->addColumn('marca_id', 'integer', [
            'null' => false,
        ]);
        $table->addColumn('model', 'string', ['limit' => 50,'null' => false]);
        $table->addColumn('year', 'integer', ['null' => true, 'default' => null]);
        $table->addColumn('placa', 'string', ['limit' => 7,'null' => false]);
        $table->addTimestamps('created', 'modified');

        $table->addForeignKey('marca_id', 'marcas', 'id', [
            'delete' => 'RESTRICT',
            'update' => 'CASCADE',
        ]);

        $table->create();
    }
}
