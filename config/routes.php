<?php
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;


Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {

    $routes->connect('/', ['controller' => 'Home', 'action' => 'index']);

    $routes->connect('/marcas', ['controller' => 'Marcas', 'action' => 'index'],['_name' =>  'marcas.index']);
    $routes->connect('/marcas/{id}', ['controller' => 'Marcas', 'action' => 'singular'],['_name' =>  'marcas.singular'])->setPass(['id']);
    $routes->connect('/marcas/{id}/carros', ['controller' => 'Marcas', 'action' => 'carros'],['_name' =>  'marcas.carros'])->setPass(['id']);
    $routes->connect('/marcas/{id}/editar', ['controller' => 'Marcas', 'action' => 'editar'], ['_name' => 'marcas.editar'])->setPass(['id'])->match(['get', 'post']);
    $routes->connect('/marcas/adicionar', ['controller' => 'Marcas', 'action' => 'adicionar'], ['_name' => 'marcas.adicionar'])->match(['get', 'post']);

    $routes->connect('/carros', ['controller' => 'Carros', 'action' => 'index'], ['_name' => 'carros.index']);
    $routes->connect('/carros/adicionar', ['controller' => 'Carros', 'action' => 'adicionar'], ['_name' => 'carros.adicionar'])->match(['get', 'post']);
    $routes->connect('/carros/{id}', ['controller' => 'Carros', 'action' => 'singular'],['_name' =>  'carros.singular'])->setPass(['id']);
    $routes->connect('/carros/{id}/editar', ['controller' => 'Carros', 'action' => 'editar'],['_name' =>  'carros.editar'])->setPass(['id']);

    $routes->fallbacks();
});


