<?php

namespace App\Presentation\Middleware;

class AfterValidation
{
    public function __invoke($request, $response, $next)
    {
        if ($request->getAttribute('has_errors')) {
            return $response->withJson($request->getAttribute('errors'), 400);
        }

        return $next($request, $response);
    }
}