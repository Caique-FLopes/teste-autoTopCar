<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Marcas Controller
 *
 */
class MarcasController extends AppController
{
  public function show($id){
    var_dump('marca ' . $id);
    die();
  }
  public function showAll(){
    var_dump('marcas');
    die();
  }
}
