<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 26.03.19
 * Time: 10:52
 */

namespace controllers;

use configs\ConfigsDB;
use classes\dataConnection\GetSourceFactory;
use classes\Logger;
use classes\Auth;
use classes\Validation;
use classes\TypeConverter;

// Это главный контроллер приложения

class AppController
{

    public function getData()
    {
        $mysql = new \mysqli("localhost", ConfigsDB::$mysqlConf['user'], ConfigsDB::$mysqlConf['pass'], ConfigsDB::$mysqlConf['db']);

        if (!$mysql->connect_errno) {

            $auth = new Auth($mysql);

            if ($auth->verifyAuthKey()) {

                $validData = (new Validation($mysql))->validateData();

                if ($validData) {

                    $dataSource = (new GetSourceFactory($validData['src'], $validData['tel'], $mysql))->createObj();

                    $source = $dataSource->searchInfo();

                    if ($source) {

                        $typeConverter = new TypeConverter($validData['type'], $source);

                        $result = $typeConverter->convertData();

                        $mysql = null;
                        return $result;

                    } else {

                        $mysql = null;
                        return 'Данные о пользователе недоступны';

                    }

                } else {

                    $mysql = null;
                    return 'Данные о пользователе недоступны';

                }

            } else {

                $mysql = null;
                return 'Авторизация не пройдена';

            }

        } else {

            $message = "Ошибка соединения с БД: {$mysql->connect_error}";

            Logger::write($message, __FILE__);

            return "Сервис не доступен";
        }
    }
}