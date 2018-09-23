<?php

namespace App\Infrastructure;

use App\Application\UsersList;
use App\Application\UsersListParams;
use GuzzleHttp\Client;

class GuzzleUsersList implements UsersList
{
    /** @var Client */
    private $client;

    /** @var string */
    private $apiAddress;

    public function __construct(Client $client, string $apiAddress)
    {
        $this->client = $client;
        $this->apiAddress = $apiAddress;
    }

    public function fetch(UsersListParams $usersListParams): array
    {
        $reqresResponse = $this->client->request(
            'GET',
            $this->apiResourceAddress($usersListParams)
        );
        return json_decode($reqresResponse->getBody()->getContents(), true);
    }

    private function apiResourceAddress(UsersListParams $usersListParams): string
    {
        $params = implode("&",[
            'per_page='.$usersListParams->perPage(),
            'page='.$usersListParams->pageNumber(),
        ]);

        return implode("", [$this->apiAddress, 'users?', $params]);
    }
}