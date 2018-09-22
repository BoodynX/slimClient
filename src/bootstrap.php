<?php

define('ROOT_DIR', dirname(__DIR__));

require ROOT_DIR . '/vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require ROOT_DIR . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require ROOT_DIR . '/src/dependencies.php';

// Register routes
require ROOT_DIR . '/src/routes.php';

// Register middleware
require ROOT_DIR . '/src/middleware.php';

// Run app
$app->run();
