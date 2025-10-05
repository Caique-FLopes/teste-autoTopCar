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
  public function index(){
    $connection = ConnectionManager::get('default');

    $tableMarcas = TableRegistry::getTableLocator()->get('marcas');
    $marcas = $tableMarcas->find()->where(['id >' => 2])->limit(2);
    
    $this->set(compact('marcas'));
    return $this->render('index', 'master');
  }
}
