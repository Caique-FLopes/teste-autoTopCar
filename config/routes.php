<?php
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;


Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {

    //normal flow
    Router::scope('/', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Home', 'action' => 'index'], ['_name' => 'home.index'])->setMethods(['get']);
    });

    //carros flow
    Router::scope('/carros', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Carros', 'action' => 'index'], ['_name' => 'carros.index'])->setMethods(['get']);
        $routes->connect('/{id}', ['controller' => 'Carros', 'action' => 'singular'], ['_name' => 'carros.singular'], ['pass' => ['id'],  'id' => '[0-9]+'])->setMethods(['get']);
    });

    //marcas flow
    Router::scope('/marcas', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Marcas', 'action' => 'showAll'], ['_name' => 'marcas.showAll'])->setMethods(['get']);
        $routes->connect('/{id}', ['controller' => 'Marcas', 'action' => 'show'], ['_name' => 'marcas.show'], ['pass' => ['id'],  'id' => '[0-9]+'])->setMethods(['get']);
    });

    //flow admin
    Router::scope('/admin', function (RouteBuilder $routes) {
        $routes->connect('/', ['controller' => 'Admin', 'action' => 'index'], ['_name' => 'admin.index'])->setMethods(['get']);
        $routes->connect('/carros', ['controller' => 'AdminCarros', 'action' => 'index'], ['_name' => 'adminCarros.index'])->setMethods(['get']);
        $routes->connect('/carros/{id}', ['controller' => 'AdminCarros', 'action' => 'show'], ['_name' => 'adminCarros.show', 'pass' => ['id'], 'id' => '[0-9]+'])->setMethods(['get']);
    });

    //flow client


    //default
    $routes->fallbacks();
});


