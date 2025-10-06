<?php
use Migrations\AbstractSeed;

/**
 * Carros seed.
 */
class CarrosSeed extends AbstractSeed
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
        $faker = \Faker\Factory::create('pt_BR');
        $now   = date('Y-m-d H:i:s');

        $marcas = $this->fetchAll('SELECT id, name FROM marcas ORDER BY id');
        if (empty($marcas)) {
            return;
        }

        $modelosPorMarca = [
            'Volkswagen' => ['Gol','Fox','Polo','Virtus','T-Cross'],
            'Fiat'       => ['Uno','Argo','Cronos','Pulse','Mobi'],
            'Chevrolet'  => ['Onix','Prisma','Tracker','Spin','Cobalt'],
            'Ford'       => ['Ka','Fiesta','Focus','EcoSport','Fusion'],
            'Toyota'     => ['Corolla','Etios','Yaris','Hilux','SW4'],
            'Honda'      => ['Civic','Fit','City','HR-V','WR-V'],
            'Hyundai'    => ['HB20','Creta','i30','Azera','Tucson'],
            'Renault'    => ['Sandero','Logan','Kwid','Duster','Captur'],
            'Peugeot'    => ['208','2008','308','3008','408'],
            'Citroën'    => ['C3','C4 Lounge','Aircross','C4 Cactus','Xsara'],
        ];

        $placasUsadas = [];
        $geraPlaca = function () use (&$placasUsadas) {
            do {
                $letras = '';
                for ($i=0; $i<3; $i++) {
                    $letras .= chr(mt_rand(65, 90));
                }
                $numeros = str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $placa = $letras . $numeros;
            } while (isset($placasUsadas[$placa]));
            $placasUsadas[$placa] = true;
            return $placa;
        };

        $rows = [];

        // Quantidade desejada por marca
        $minPorMarca = 6;
        $maxPorMarca = 12;

        foreach ($marcas as $m) {
            $marcaId   = (int)$m['id'];
            $nomeMarca = $m['name'];

            $modelos = $modelosPorMarca[$nomeMarca] ?? ['ModeloX','ModeloY','ModeloZ'];
            $qtd     = mt_rand($minPorMarca, $maxPorMarca);

            for ($i = 0; $i < $qtd; $i++) {
                $rows[] = [
                    'marca_id' => $marcaId,
                    'model'    => $faker->randomElement($modelos),
                    'year'     => (int)$faker->numberBetween(2005, 2025),
                    'placa'    => $geraPlaca(),
                    'created'  => $now,
                    'modified' => $now,
                ];
            }
        }

        if ($rows) {
            $this->table('carros')->insert($rows)->saveData();
        }
    }
}
