<?php
namespace App\Models;

use \Slim\Container;

abstract class User
{
    
    public static function getByLogin(Container $c, array $data)
    {
        $db = $c->get('db');
        $statement = $db->prepare('SELECT * FROM users WHERE username = :username');
        $statement->bindValue('username', $data['username'], \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch();
        return password_verify($data['password'], $result['password']);
    }
    
}
