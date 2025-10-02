<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Carros Controller
 *
 */
class CarrosController extends AppController
{
  public function show($id){
    var_dump('carros ' . $id);

    die();
  }
  public function showAll(){
    var_dump('show all');

    die();
  }
}
