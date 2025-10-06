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

  private function _getMarcas($id = null){
    $tableMarcas = TableRegistry::getTableLocator('default')->get('marcas');

    if($id) return $tableMarcas->get($id);

    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    $ids = $tableSituacoes->find()->select(['id_item'])->where(['description' => 'active', 'table_item' => 'marcas']);
    return $tableMarcas->find()->where(['id IN' => $ids]);
  }

  private function _insertMarca($data){
    $tableMarcas = TableRegistry::getTableLocator('default')->get('marcas');
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    try {
        $newMarca =  $tableMarcas->newEntity($data);
        $tableMarcas->saveOrFail($newMarca);
        $newSituacao = $tableSituacoes->newEntity(['id_item' => $newMarca->id, 'table_item' => 'marcas']);
        $tableSituacoes->saveOrFail($newSituacao);
      } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
        var_dump( $e->getEntity());
      } finally{
        $this->redirect(['_name' => 'marcas.index']);
      }
  }

  private function _getCarrosAtivos($id){
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    $tableCarros = TableRegistry::getTableLocator('default')->get('carros');

    $ids = $tableSituacoes->find()->select(['id_item'])->where(['description' => 'active', 'table_item' => 'carros']);
    return $tableCarros->find()->where(['id IN' => $ids, 'marca_id =' => $id]);
  }

  
  private function _deleteMarca($id){
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    $tableSituacoes->updateAll(['description' => 'deleted'],['id_item' => $id, 'table_item' => 'marcas']); 
    $this->redirect(['_name' => 'marcas.index']);
  }

  private function _updateMarca($id, $data){
    $tableMarcas = TableRegistry::getTableLocator('default')->get('marcas');
    $tableMarcas->updateAll($data, ['id ='=> $id]);
    $this->redirect(['_name' => 'marcas.index']);
  }

  public function index(){
    $marcas = $this->_getMarcas();
    $this->set(compact('marcas'));
  }
  
  public function editar($id){
    $marcaAtual = $this->_getMarcas($id);

    if($this->getRequest()->is('delete')){
      $this->_deleteMarca($id);
    }

    if($this->getRequest()->is('post')){
      $this->_updateMarca($id, $this->getRequest()->getData());
    }

    $this->set(compact('marcaAtual'));
  }

  public function singular($id){
    $marca = $this->_getMarcas($id);
    $this->set(compact('marca'));
  }

  public function adicionar(){
    if($this->getRequest()->is('post')){
     $this->_insertMarca($this->getRequest()->getData());
    }
  }

  public function carros($id){
    $marca = $this->_getMarcas($id);
    $carros = $this->_getCarrosAtivos($id);
    $this->set(compact('carros', 'marca'));
  }
}
