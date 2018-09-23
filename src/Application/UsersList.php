<?php

namespace App\Application;

interface UsersList
{
    public function fetch(UsersListParams $listParams): array;
}