<?php
/**
 * Created by PhpStorm.
 * User: yafus
 * Date: 23.03.19
 * Time: 11:38
 */

require_once 'vendor/autoload.php';

use controllers\AppController;

$data = (new AppController())->getData();

echo $data;







