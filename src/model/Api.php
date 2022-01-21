<?php

namespace App\model;

class Api
{

    protected ApiUsers $apiUsers;   // объект пользователя
    protected array $requestUri;    // URI клиента
    protected string $method;       // CRUD запрос

    public function __construct()
    {
        header("Access-Control-Allow-Orgin:*");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");

        $dateBase = new Database();                             // Объект БД
        $this->apiUsers = new ApiUsers($dateBase->connect());   // Объект пользователя
        $this->requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));   // URI клиента
        $this->method = $_SERVER['REQUEST_METHOD'];         //Метода запроса
    }

    public function run(): ?bool
    {
        //Первый элемент массива URI должны быть "api"
        if (array_shift($this->requestUri) !== 'api') {
            throw new \Exception('API Not Found', 404);
        }
        //Определение действия для обработки
        $method = $this->method;
        $apiUsers = $this->apiUsers;
        switch ($method) {
            case 'GET':                        // Метод HTTP
                echo $apiUsers->getUserById(); // Просмотр пользователя (по id) - http://ДОМЕН/users/1
                return 'true';
                break;
            case 'POST':                        // Метод HTTP
                return $apiUsers->createUser(); // Создание пользователя - http://ДОМЕН/users + параметры запроса name, email, password, role
                break;
            case 'PUT':                         // Метод HTTP
                return $apiUsers->updateUser(); // Обновление данных пользователя - http://ДОМЕН/users + параметры запроса name, password
                break;
            case 'DELETE':                      // Метод HTTP
                return $apiUsers->deleteUser(); // Удаление пользователя (по id) - http://ДОМЕН/users/1
                break;
            default:
                return false;
        }
    }
}