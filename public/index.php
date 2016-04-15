<?php

require __DIR__.'/../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$settings = ['displayErrorDetails' => true];

$app = new \Slim\App(['settings' => $settings]);

$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer(__DIR__.'/../src/templates/');

$app->get('/', function (Request $request, Response $response) {
    return $this->view->render($response, 'home.html');
});

$app->run();