<?php

namespace App\Presentation\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Route;

class ValidationErrorsReport
{
    public function __invoke(Request $request, Response $response, Route $next)
    {
        if ($request->getAttribute('has_errors')) {
            return $response->withJson($request->getAttribute('errors'), 400);
        }

        return $next($request, $response);
    }
}