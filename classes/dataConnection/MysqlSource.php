<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 24.03.19
 * Time: 17:09
 */

namespace classes\dataConnection;

use classes\Logger;

// Это класс для поиска данных о пользователе в MySQL

class MysqlSource
{
    private $mysql;
    private $data;

    public function __construct(string $data, \mysqli $mysql)
    {
        $this->mysql = $mysql;
        $this->data = $data;
    }

    public function searchInfo()
    {

        $query = "SELECT tel, name, city, country FROM users WHERE `tel`={$this->data}";

        $answerFromDB = mysqli_query($this->mysql, $query);

        if (!$answerFromDB) {

            $message = "Ошибка при запросе в БД: {$this->mysql->errno}";
            Logger::write($message, __FILE__);

            return false;
        }

        $row = mysqli_fetch_assoc($answerFromDB);

        if (isset($row)) {

            return $row;

        } else {

            return false;

        }
    }
}