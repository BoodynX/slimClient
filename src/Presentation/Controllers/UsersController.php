<?php

namespace App\Presentation\Controllers;

use App\Application\UserList;
use App\Application\UsersListParams;
use GuzzleHttp\Client;
use Slim\Http\Request;
use Slim\Http\Response;

class UsersController
{
    /** @var Client */
    protected $usersList;

    public function __construct(UserList $usersList)
    {
        $this->usersList = $usersList;
    }

    public function index(Request $request, Response $response, array $args): Response
    {
        $param = $request->getParams();
        $usersListParams = new UsersListParams($param['per_page'], $param['page']);
        $jsonData = $this->usersList->fetch($usersListParams);

        return $response->withJson($jsonData);
    }
}