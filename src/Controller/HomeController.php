<?php
namespace App\Controller;

use App\Controller\AppController;
use phpDocumentor\Reflection\Types\This;

/**
 * Home Controller
 *
 */
class HomeController extends AppController
{
  public function index(){
    $name = 'Caique';
    $age = 23;

    $this->set(compact('name', 'age'));
    return $this->render('index', 'master');
  }
}
