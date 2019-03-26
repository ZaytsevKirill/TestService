<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 24.03.19
 * Time: 17:54
 */

namespace classes\dataConnection;

//  Этот класс создает объект для доступа к ресурсу

class GetSourceFactory
{
    private $tel;
    private $src;
    private $mysql;

    public function __construct(string $src, string $tel, \mysqli $mysql)
    {
        $this->tel = $tel;
        $this->src = $src;
        $this->mysql = $mysql;
    }

    public function createObj()
    {
        if ($this->src === 'mysql') {

            return new MysqlSource($this->tel, $this->mysql);

        } elseif ($this->src === 'file') {

            return new FileSource($this->tel);

        } elseif ($this->src === 'service') {

            return new ServiceSource($this->tel);
        }
    }
}