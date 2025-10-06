<?php
use Migrations\AbstractSeed;

/**
 * Situacoes seed.
 */
class SituacoesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // IDs de marcas e carros já inseridos
        $marcas = $this->fetchAll('SELECT id FROM marcas');
        $carros = $this->fetchAll('SELECT id FROM carros');

        $rows = [];

        foreach ($marcas as $m) {
            $rows[] = [
                'description' => 'active',
                'id_item'     => (int)$m['id'],
                'table_item'  => 'marcas',
                'created'     => $now,
                'modified'    => $now,
            ];
        }

        foreach ($carros as $c) {
            $rows[] = [
                'description' => 'active',
                'id_item'     => (int)$c['id'],
                'table_item'  => 'carros',
                'created'     => $now,
                'modified'    => $now,
            ];
        }

        if ($rows) {
            $this->table('situacoes')->insert($rows)->saveData();
        }
    }
}
