<?php
$middlewareConfig = require ROOT_DIR . '/src/middleware_config.php';

foreach ($middlewareConfig['global'] as $middleware) {
    $app->add($middleware);
}

foreach ($middlewareConfig['routes'] as $name => $routeMiddleware) {
    try {
        $route = $app->getContainer()->get('router')->getNamedRoute($name);
        foreach ($routeMiddleware as $middleware) {
            $route->add($middleware);
        }
    } catch (\RuntimeException $e) {
        if (stripos('Named route does not exist for name:', $e->getMessage()) !== 0) {
            throw $e;
        }
    }
}

