<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 23.03.19
 * Time: 17:34
 */

// Это класс для получения данных из сервиса

namespace classes\dataConnection;

use classes\Logger;

class ServiceSource
{
    private $tel;

    public function __construct(string $tel)
    {
        $this->tel = $tel;
    }

    public function searchInfo()
    {
        $src = "http://{$_SERVER['HTTP_HOST']}/resourses/service/OutSource.php?tel={$this->tel}";

        $answer = file_get_contents($src);

        if ($answer === 'Данных нет' || $answer == false) {

            $message = "Ошибка в получении данных из внешнего источника";

            Logger::write($message, __FILE__);

            return false;

        } else {

            $res = json_decode($answer, true);

            return $res;

        }
    }
}