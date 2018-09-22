<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => ROOT_DIR . '/templates/',
            'cache_path' => false //ROOT_DIR . '/cache/template',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : ROOT_DIR . '/logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
