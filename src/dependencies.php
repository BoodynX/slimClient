<?php

use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

$container = $app->getContainer();

// view renderer
$container['view'] = function ($container) {
    $settings = $container->get('settings')['renderer'];
    $view = new Twig($settings['template_path'], [
        'cache' => $settings['cache_path']
    ]);
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new TwigExtension($container->get('router'), $basePath));

    return $view;
};

// monolog
$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Logger($settings['name']);
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// HTTP client
$container['httpClient'] = function () {
    $httpClient = new Client();
    return $httpClient;
};

// Controllers
$container['\App\Presentation\Controllers\HomeController'] = function ($container) {
    $view = $container->get('view');
    return new \App\Presentation\Controllers\HomeController($view);
};

$container['\App\Presentation\Controllers\UsersController'] = function ($container) {
    $httpClient = $container->get('httpClient');
    return new \App\Presentation\Controllers\UsersController($httpClient);
};
