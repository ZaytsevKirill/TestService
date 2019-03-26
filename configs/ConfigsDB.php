<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 24.03.19
 * Time: 13:08
 */

namespace configs;

// Класс с параметрами подключения к БД Mysql

class ConfigsDB
{
    public static $mysqlConf = [
        'db' => 'test',
        'pass' => 'root',
        'user' => 'root'
    ];
}