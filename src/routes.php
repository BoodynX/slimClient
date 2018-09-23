<?php

use App\Presentation\Controllers\HomeController;
use App\Presentation\Controllers\UsersController;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/test/[{name}]', function (Request $request, Response $response, array $args) {
    $this->logger->info("Slim-Skeleton '/' route");
    return $this->view->render($response, 'index.phtml', $args);
});

$app->get('/', HomeController::class.':home')
    ->setName('home');

// API
$app->get('/api/users', UsersController::class.':index')
    ->setName('users');


