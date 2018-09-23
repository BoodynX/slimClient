<?php

use Respect\Validation\Validator as v;
use App\Presentation\Middleware\ValidationErrorsReport;
use DavidePastore\Slim\Validation\Validation;

return [
    'global' => [
        //
    ],
    'routes' => [
        'users' => [
            new ValidationErrorsReport,
            new Validation([
                'page' => v::notOptional()->numeric()->positive(),
                'per_page' => v::notOptional()->numeric()->positive(),
            ]),
        ],
    ],
];