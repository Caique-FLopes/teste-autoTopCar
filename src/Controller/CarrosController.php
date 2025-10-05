<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Carros Controller
 *
 */
class CarrosController extends AppController
{
  public function index(){
    $tableCarros = TableRegistry::getTableLocator('default')->get('carros');
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');

    $ids = $tableSituacoes->find()->select(['id_item'])->where(['description' => 'active', 'table_item' => 'carros']);
    $carros = $tableCarros->find()->where(['id IN' => $ids]);
    $this->set(compact('carros'));
  }
  public function singular($id){
    var_dump('carros ' . $id);

    die();
  }
  public function adicionar(){
    $tableCarros = TableRegistry::getTableLocator('default')->get('carros');
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    $tableMarcas = TableRegistry::getTableLocator('default')->get('marcas');

    $ids = $tableSituacoes->find()->select(['id_item'])->where(['description' => 'active', 'table_item' => 'marcas']);
    $marcas = $tableMarcas->find()->where(['id IN' => $ids]);
    if($this->getRequest()->is('post')){
      try {
        $newCarro =  $tableCarros->newEntity($this->getRequest()->getData());
        $tableCarros->saveOrFail($newCarro);
        $newSituacao = $tableSituacoes->newEntity(['id_item' => $newCarro->id, 'table_item' => 'carros']);
        $tableSituacoes->saveOrFail($newSituacao);
      } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
        var_dump( $e->getEntity());
      } finally{
        $this->redirect(['_name' => 'carros.index']);
      }
    }
    $this->set(compact('marcas'));
  }
}
