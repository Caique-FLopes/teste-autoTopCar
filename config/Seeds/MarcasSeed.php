<?php
use Migrations\AbstractSeed;

/**
 * Marcas seed.
 */
class MarcasSeed extends AbstractSeed
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

        $nomesMarcas = [
            'Volkswagen','Fiat','Chevrolet','Ford','Toyota',
            'Honda','Hyundai','Renault','Peugeot','Citroën'
        ];

        $rows = array_map(function ($nome) use ($now) {
            return [
                'name'      => $nome,
                'logo_file' => null,
                'created'   => $now,
                'modified'  => $now,
            ];
        }, $nomesMarcas);

        $this->table('marcas')->insert($rows)->saveData();
    }
}
