<?php
namespace App\Models;

use \Slim\Container;

abstract class User
{
    
    public static function getByLogin(Container $c, array $data)
    {
        $db = $c->get('db');
        var_dump($data); exit;
        return true;
    }
    
}
