<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Marca;
use App\Model\Entity\Situaco;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use Exception;

/**
 * Marcas Controller
 *
 */
class MarcasController extends AppController
{ 
  public function index(){
    $tableMarcas = TableRegistry::getTableLocator('default')->get('marcas');
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');

    $ids = $tableSituacoes->find()->select(['id_item'])->where(['description' => 'active', 'table_item' => 'marcas']);
    $marcas = $tableMarcas->find()->where(['id IN' => $ids]);
    $this->set(compact('marcas'));
  }
  public function editar($id){
    $tableMarcas = TableRegistry::getTableLocator('default')->get('marcas');

    $marcaAtual = $tableMarcas->get($id);

    if($this->getRequest()->is('delete')){
      $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
      $tableSituacoes->updateAll(['description' => 'deleted'],['id_item' => $id, 'table_item' => 'marcas']); 
      $this->redirect(['_name' => 'marcas.index']);
    }

    if($this->getRequest()->is('post')){
      var_dump($this->getRequest()->getData());
      $tableMarcas->updateAll($this->getRequest()->getData(), ['id ='=> $id]);
      $this->redirect(['_name' => 'marcas.index']);
    }

    $this->set(compact('marcaAtual'));
  }
  public function singular($id){
    $tableMarcas = TableRegistry::getTableLocator('default')->get('marcas');
    $this->set(compact('marcas'));
  }
  public function adicionar(){
    $tableMarcas = TableRegistry::getTableLocator('default')->get('marcas');
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');

    if($this->getRequest()->is('post')){
      try {
        $newMarca =  $tableMarcas->newEntity($this->getRequest()->getData());
        $tableMarcas->saveOrFail($newMarca);
        $newSituacao = $tableSituacoes->newEntity(['id_item' => $newMarca->id, 'table_item' => 'marcas']);
        $tableSituacoes->saveOrFail($newSituacao);
      } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
        var_dump( $e->getEntity());
      }
    }
  }
}
