<?php

namespace App\Presentation\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class HomeController
{
    /** @var Twig */
    protected $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    public function home(
        Request $request,
        Response $response,
        array $args
    ): ResponseInterface {

        $viewData = [
            'users' => [
                [
                    'id' => 1,
                    'first_name' => 'Tom',
                    'last_name' => 'Boodyn'
                ],
            ]
        ];
        return $this->view->render($response, 'Home.html.twig', $viewData);
    }
}