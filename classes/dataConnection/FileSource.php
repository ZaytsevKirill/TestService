<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 23.03.19
 * Time: 17:34
 */

// Это класс для получения данных из файла

namespace classes\dataConnection;

use classes\Logger;

class FileSource
{
    private $filename;

    public function __construct(string $filename)
    {
        $this->filename = "{$_SERVER['DOCUMENT_ROOT']}/resourses/files/{$filename}";
    }

    public function searchInfo()
    {

        $str = file_get_contents($this->filename);

        if ($str) {

            $res = json_decode($str, true);

            return $res;

        } else {

            $message = "Ошибка в получении данных из файла";

            Logger::write($message, __FILE__);

            return false;

        }
    }
}