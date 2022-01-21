<?php
namespace App\model;

use PDO;

class Database
{
    /**
     *   Подключение к БД
     */
    public string $dsn;
    public string $username;
    public string $password;

    public function __construct()
    {
        $config = include __DIR__ . '/../../config/config.php';        // Данные для подключения к БД
        $this->dsn = $config['dsn'];                                   // Имя DSN
        $this->username = $config['username'];                         // Имя БД
        $this->password = $config['password'];                         // Пароль БД
    }

    public function connect(): PDO
    {
        try {
            $connection = new PDO($this->dsn, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));     // Подключение к БД с помощью встроенного класса PHP
            $connection->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);         // Устанавливает атрибуты объекту PDO(режим сообщений об ошибках,выбрасывать исключения.)
            $connection->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);    // Устанавливает атрибуты объекту PDO(режим выборки данных по умолчанию,)
            return $connection;
        } catch (\PDOException $exception) {
            echo 'Datebase error:' . $exception->getMessage();                                          // Поймать исключение в случае ошибки
            die();
        }
    }
}