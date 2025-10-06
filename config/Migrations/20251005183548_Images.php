<?php
use Migrations\AbstractMigration;

class Images extends AbstractMigration
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
        $table = $this->table('images', ['engine' => 'InnoDB']);

        $table->addColumn('url_image', 'string', ['null' => false]);
        $table->addColumn('id_item', 'integer', ['null' => false]);
        $table->addColumn('table_item', 'string', ['null' => false]);
        $table->addTimestamps('created', 'modified');
        $table->create();
    }
}
