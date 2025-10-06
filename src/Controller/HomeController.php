<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use phpDocumentor\Reflection\Types\This;

/**
 * Home Controller
 *
 */
class HomeController extends AppController
{
  private function _getMarcasAtivas(){
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    $tableMarcas = TableRegistry::getTableLocator('default')->get('marcas');

    $ids = $tableSituacoes->find()->select(['id_item'])->where(['description' => 'active', 'table_item' => 'marcas']);
    return $tableMarcas->find()->where(['id IN' => $ids]);
  }

  private function _getCarrosAtivos(){
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    $tableCarros = TableRegistry::getTableLocator('default')->get('carros');

    $ids = $tableSituacoes->find()->select(['id_item'])->where(['description' => 'active', 'table_item' => 'carros']);
    return $tableCarros->find()->where(['id IN' => $ids]);
  }

  private function _getImages(){
    $tableSituacoes = TableRegistry::getTableLocator('default')->get('situacoes');
    $tableImages = TableRegistry::getTableLocator('default')->get('images');

    $ids = $tableSituacoes->find()->select(['id_item'])->where(['description' => 'active', 'table_item' => 'images']);
    return $tableImages->find()->where(['id IN' => $ids]);
  }

  public function index(){
    $marcas = $this->_getMarcasAtivas();
    $carros = $this->_getCarrosAtivos();
    $images = $this->_getImages();

    $this->set(compact('marcas', 'carros', 'images'));
  }
}
