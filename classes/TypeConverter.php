<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 24.03.19
 * Time: 22:50
 */

namespace classes;


class TypeConverter
{
    private $type;
    private $data;

    public function __construct(string $type, array $data)
    {
        $this->type = $type;
        $this->data = $data;
    }


    public function convertData()
    {
        if ($this->type=== 'json') {

            return json_encode($this->data);

        } elseif ($this->type === 'xml') {

            $xml = new \SimpleXMLElement('<root/>');

            $data = array_flip($this->data);

            array_walk_recursive($data, array ($xml, 'addChild'));

            return $xml->asXML();

        }
    }
}