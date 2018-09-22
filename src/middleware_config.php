<?php

use Respect\Validation\Validator as v;
use App\Presentation\Middleware\AfterValidation;
use DavidePastore\Slim\Validation\Validation;

return [
    'global' => [
        //
    ],
    'routes' => [
        'users' => [
            new AfterValidation,
            new Validation([
                'page' => v::notOptional()->numeric()->positive(),
                'per_page' => v::notOptional()->numeric()->positive(),
            ]),
        ],
    ],
];