<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/test/[{name}]', function (Request $request, Response $response, array $args) {
    $this->logger->info("Slim-Skeleton '/' route");
    return $this->view->render($response, 'index.phtml', $args);
});

$app->get('/', '\App\Presentation\Controllers\HomeController:home')
    ->setName('home');

// API
$app->get('/api/users', '\App\Presentation\Controllers\UsersController:index')
    ->setName('users');


