<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 23.03.19
 * Time: 17:34
 */

namespace classes;

// Это класс валидации входящих данных

class Validation
{
    private $telValid;
    private $typeValid;
    private $pattern = "/^0[3,5,6,9]\d{8}$/";
    private $mysql;


    public function __construct(\mysqli $mysql)
    {
        $this->telValid = $_GET['tel'] ?? null;
        $this->typeValid = $_GET['type'] ?? null;
        $this->mysql = $mysql;
    }

    public function validateData()
    {
        $dataArr = [
            'tel' => null,
            'type' => null,
            'src' => null,
        ];

        if (preg_match($this->pattern, $this->telValid) === 1) {

            $dataArr['tel'] = $this->telValid;

            $query = "SELECT * FROM source WHERE `tel`={$dataArr['tel']}";

            $answerFromDB = mysqli_query($this->mysql, $query);

            if (!$answerFromDB) {

                $message = "Ошибка при запросе в БД: {$this->mysql->errno}";
                Logger::write($message, __FILE__);

                return false;
            }

            $row = mysqli_fetch_assoc($answerFromDB);

            if (isset($row['src'])) {
                $dataArr['src'] = $row['src'];
            }

            if ($this->typeValid === 'json' || $this->typeValid === 'xml') {
                $dataArr['type'] = $this->typeValid;
            }
        }

        return (isset($dataArr['tel']) && isset($dataArr['type']) && isset($dataArr['src'])) ? $dataArr : false;
    }
}