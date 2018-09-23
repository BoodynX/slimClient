<?php

use App\Infrastructure\GuzzleUsersList;
use App\Presentation\Controllers\HomeController;
use App\Presentation\Controllers\UsersController;
use App\Presentation\Presenters\UsersList as UsersListPresenter;
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

$container['UsersList'] = function ($container) {
    return new GuzzleUsersList(
        $container->get('httpClient'),
        $container->get('settings')['apiAddress']
    );
};

///////////////////////////////////////////////////////////////////////
// Controllers
///////////////////////////////////////////////////////////////////////

$container[HomeController::class] = function ($container) {
    $view = $container->get('view');
    return new HomeController($view);
};

$container[UsersController::class] = function ($container) {
    return new UsersController(
        $container->get('UsersList'),
        new UsersListPresenter
    );
};
