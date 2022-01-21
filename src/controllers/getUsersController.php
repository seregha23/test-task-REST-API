<?php

namespace App\controllers;

use PDO;

class getUsersController
{
    protected array $requestUri;
    protected array $request;

    public function __construct(array $requestUri, array $request)
    {
        $this->requestUri = $requestUri;
        $this->request = $request;
    }

    // метод GET
    public function getUserControllerByID(): ?string
    {
        return $this->requestUri[2];
    }

    // Метод POST
    public function postUserController(): ?array
    {
        return $this->request;
    }

    // Метод PUT
    public function updateUserController(): ?array
    {
        return $this->request;
    }

    // метод DELETE
    public function deleteUserControllerByID(): ?string
    {
        return $this->requestUri[2];
    }
}