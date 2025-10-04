<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Carros Controller
 *
 */
class CarrosController extends AppController
{
  public function index(){
    return $this->render('index', 'master');
  }
  public function singular($id){
    var_dump('carros ' . $id);

    die();
  }
}
