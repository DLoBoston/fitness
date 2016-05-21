<?php
/**
 * User model
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */
namespace App\Models;

use \Slim\Container;

/**
 * Models interaction with user entity in persistent data store.
 */
abstract class User
{
    
    /**
     * Get user's ID from persistent data store if username and password match.
     *
     * @param array $c Dependency container
     * @param array $data Contains username and password
     * @return int|bool User's ID if found, else false
     */
    public static function getIdByLogin(Container $c, array $data)
    {
        // Get user by username
        $db = $c->get('db');
        $statement = $db->prepare('SELECT * FROM users WHERE username = :username');
        $statement->bindValue('username', $data['username'], \PDO::PARAM_STR);
        $statement->execute();
        
        // Validate password matches
        $result = $statement->fetch();
        $passwordMatches = password_verify($data['password'], $result['password']);
        
        // Return ID if match, else false
        return ($passwordMatches) ? $result['id'] : false;
    }
    
}