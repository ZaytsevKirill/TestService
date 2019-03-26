<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 25.03.19
 * Time: 20:54
 */

$answer = '{"name":"Zaytsev Kirill","city":"Dnepr","country":"Ukraine","tel":"0636376909"}';

if ($_GET['tel'] === '0636376909') {

    echo $answer;

} else {

    echo 'Данных нет';

}

