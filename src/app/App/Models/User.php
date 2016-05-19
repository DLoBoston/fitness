<?php
namespace App\Models;

use \Slim\Container;

abstract class User
{
    
    public static function getByLogin(Container $c, array $data)
    {
        $db = $c->get('db');
        $statement = $db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
        $statement->bindValue('username', $data['username'], \PDO::PARAM_STR);
        $statement->bindValue('password', $data['password'], \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }
    
}
