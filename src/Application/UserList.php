<?php

namespace App\Application;

interface UserList
{
    public function fetch(UsersListParams $listParams): array;
}