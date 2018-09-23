<?php

namespace App\Application;

class UsersListParams
{
    /** @var int */
    private $perPage;

    /** @var int */
    private $pageNumber;

    public function __construct(int $perPage, int $pageNumber)
    {
        $this->perPage = $perPage;
        $this->pageNumber = $pageNumber;
    }

    public function perPage(): int
    {
        return $this->perPage;
    }

    public function pageNumber(): int
    {
        return $this->pageNumber;
    }
}