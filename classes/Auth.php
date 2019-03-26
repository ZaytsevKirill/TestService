<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 23.03.19
 * Time: 23:40
 */

namespace classes;

// Это класс для авторизации клиента

class Auth
{
    private $authKey;
    private $pattern = "/^\d{5}$/";
    private $mysql;

    public function __construct(\mysqli $mysql)
    {
        $this->authKey = $_SERVER["HTTP_AUTHKEY"] ?? null;
        $this->mysql = $mysql;
    }

    public function verifyAuthKey()
    {

        if ((preg_match($this->pattern, $this->authKey) === 1)) {

            $query = "SELECT * FROM auth WHERE `key`={$this->authKey}";

            $answerFromDB = mysqli_query($this->mysql, $query);

            if (!$answerFromDB) {

                $message = "Ошибка при запросе в БД: {$this->mysql->errno}";
                Logger::write($message, __FILE__);

                return false;
            }

            $row = mysqli_fetch_assoc($answerFromDB);

            return ($row) ? true : false;

        } else {

            return false;

        }
    }
}