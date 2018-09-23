<?php

namespace App\Presentation\Controllers;

use App\Application\UserList;
use App\Application\UsersListParams;
use App\Presentation\Presenters\UsersList as UsersListPresenter;
use GuzzleHttp\Client;
use Slim\Http\Request;
use Slim\Http\Response;

class UsersController
{
    /** @var Client */
    protected $usersList;

    /** @var UsersListPresenter */
    private $usersListPresenter;

    public function __construct(UserList $usersList, UsersListPresenter $UsersListPresenter)
    {
        $this->usersList = $usersList;
        $this->usersListPresenter = $UsersListPresenter;
    }

    public function index(Request $request, Response $response): Response
    {
        $param = $request->getParams();
        $usersListParams = new UsersListParams($param['per_page'], $param['page']);
        $usersList = $this->usersList->fetch($usersListParams);

        return $response->withJson($this->usersListPresenter->show($usersList));
    }
}