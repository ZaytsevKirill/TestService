<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 23.03.19
 * Time: 17:31
 */

// Это класс для логирования ошибок

namespace classes;

class Logger
{

    static function write(string $message, string $nameFile)
    {
        $date = date('Y-m-d H:i:s');
        $space = str_repeat ( " " , 22);

        $message = "{$date} - Ошибка в файле - {$nameFile}" . PHP_EOL . $space . $message . PHP_EOL;

        $file_path = "{$_SERVER['DOCUMENT_ROOT']}/logs/main.txt";

        $handle = fopen($file_path, "a");

        @flock($handle, LOCK_EX);
        fwrite($handle, $message);
        @flock($handle, LOCK_UN);
        fclose($handle);

        return true;
    }
}
