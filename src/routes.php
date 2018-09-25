<?php

use App\Presentation\Controllers\HomeController;
use App\Presentation\Controllers\UsersController;

$app->get('/', HomeController::class.':home')
    ->setName('home');

// API
$app->get('/api/users', UsersController::class.':index')
    ->setName('users');


