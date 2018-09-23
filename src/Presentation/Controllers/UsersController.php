<?php

namespace App\Presentation\Controllers;

use GuzzleHttp\Client;
use Slim\Http\Request;
use Slim\Http\Response;

class UsersController
{
    /** @var Client */
    protected $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function index(Request $request, Response $response, array $args): Response
    {
        $param = $request->getParams();
        $reqresResponse = $this->httpClient->request(
            'GET',
            'https://reqres.in/api/users?per_page='.$param['per_page'].'&page='.$param['page']
        );
        $reqresData = json_decode($reqresResponse->getBody()->getContents(), true);
        $jsonData = [
            'users' => $reqresData['data']
        ];

        return $response->withJson($jsonData);
    }
}