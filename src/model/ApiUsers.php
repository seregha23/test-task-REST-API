<?php

namespace App\model;

use App\controllers\getUsersController;
use PDO;
use function App\debugLog;

class ApiUsers
{
    protected getUsersController $usersController;  // Controller
    protected array $requestUri;                    // URI клиента
    protected PDO $connection;                      // Соединение с БД

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $this->usersController = new getUsersController($this->requestUri, $_REQUEST);
    }

    // Просмотр пользователя - method GET
    public function getUserById(): ?string
    {
        $id = $this->usersController->getUserControllerByID();      // id пользователя
        $statement = $this->connection->prepare(
            "SELECT * FROM Users WHERE ID ='" . $id . "'"
        );
        $statement->execute();
        $users = $statement->fetchAll();
        return json_encode($users[0], JSON_UNESCAPED_UNICODE);
    }

    // Создание пользователя - method POST
    public function createUser(): ?string
    {
        $request = $this->usersController->postUserController();    // Параметры запроса для создания пользователя (массив)
        $statement = $this->connection->prepare(
            "INSERT INTO Users ( NAME, MAIL, PASSWORD, ROLE_ID) VALUES ('" . $request['name'] . "','" . $request['mail'] . "','" . $request['password'] . "','" . $request['role'] . "')"
        );
        $statement->execute();
        return json_encode($statement->fetchAll(), JSON_UNESCAPED_UNICODE);
    }

    // Обновление данных пользователя - method PUT
    public function updateUser(): ?string
    {
        $request = $this->usersController->updateUserController(); // Параметры запроса для обновления полей (имя,пароль) пользователя (массив)
//        debugLog($request,'2.loc');
        $statement = $this->connection->prepare(
            "UPDATE Users SET NAME = '" . $request['name'] . "', PASSWORD = '" . $request['password'] . "' WHERE ID = '" . $request['id'] . "'"
        );
        $statement->execute();
        return json_encode($statement->fetchAll(), JSON_UNESCAPED_UNICODE);
    }

    // Удалить пользователя - method DELETE
    public function deleteUser(): ?string
    {
        $id = $this->usersController->deleteUserControllerByID();   // id пользователя
        $statement = $this->connection->prepare(
            "DELETE FROM Users WHERE ID ='" . $id . "'"
        );
        $statement->execute();
        $users = $statement->fetchAll();
        return json_encode($users[0], JSON_UNESCAPED_UNICODE);
    }
}