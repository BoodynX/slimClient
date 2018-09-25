<?php

namespace Tests\Unit;

use App\Application\UsersListParams;
use App\Infrastructure\GuzzleUsersList;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class GuzzleUsersListTest extends TestCase
{
    public function test_fetching_users()
    {
        $usersListParamsMock = $this->usersListParamsMock();
        $clientMock = $this->guzzleClientMock();
        $settings = 'https://reqres.in/api/';

        $guzzleUsersList = new GuzzleUsersList($clientMock, $settings);
        $response = $guzzleUsersList->fetch($usersListParamsMock);

        $this->assertEquals(json_decode($this->jsonResponse(), true), $response);
    }

    private function guzzleClientMock()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $this->jsonResponse()),
        ]);

        $handler = HandlerStack::create($mock);
        return new Client(['handler' => $handler]);

    }

    private function usersListParamsMock()
    {
        $userListParams = $this->getMockBuilder(UsersListParams::class)
            ->setConstructorArgs([5, 1])
            ->setMethods(['perPage', 'pageNumber'])
            ->getMock();

        $userListParams->expects($this->once())
            ->method('perPage')
            ->willReturn(5);

        $userListParams->expects($this->once())
            ->method('pageNumber')
            ->willReturn(1);

        return $userListParams;
    }

    private function jsonResponse()
    {
        return '
                {
                    "users": [
                    {
                      "id": 1,
                      "first_name": "George",
                      "last_name": "Bluth",
                      "avatar": "https://s3.amazonaws.com/uifaces/faces/twitter/calebogden/128.jpg"
                    },
                    {
                      "id": 2,
                      "first_name": "Janet",
                      "last_name": "Weaver",
                      "avatar": "https://s3.amazonaws.com/uifaces/faces/twitter/josephstein/128.jpg"
                    },
                    {
                      "id": 3,
                      "first_name": "Emma",
                      "last_name": "Wong",
                      "avatar": "https://s3.amazonaws.com/uifaces/faces/twitter/olegpogodaev/128.jpg"
                    },
                    {
                      "id": 4,
                      "first_name": "Eve",
                      "last_name": "Holt",
                      "avatar": "https://s3.amazonaws.com/uifaces/faces/twitter/marcoramires/128.jpg"
                    },
                    {
                      "id": 5,
                      "first_name": "Charles",
                      "last_name": "Morris",
                      "avatar": "https://s3.amazonaws.com/uifaces/faces/twitter/stephenmoon/128.jpg"
                    }
                    ],
                    "metadata": {
                    "page": 1,
                    "per_page": 5,
                    "total": 12,
                    "total_pages": 3
                    }
                }
            ';
    }
}