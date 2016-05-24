<?php
/**
 * User model
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */
namespace App\Models;

use \Slim\Container;
use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with users entity in persistent data store.
 * A user can have different roles in the system, like admin and normal user.
 */
class User extends Model
{
    /**
     * This function is an Eloquent convention that creates a relationship between the User and Workout models.
     *
     * @return \Illuminate\Database\Eloquent\Collection A collection of workouts or null
     */
    public function workouts() {
        return $this->hasMany('\App\Models\Workout');
    }
    
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
        $c->get('orm');
        $user = self::where('username', $data['username'])->first();
        
        // Validate password matches
        $passwordMatches = password_verify($data['password'], $user->password);
        
        // Return ID if match, else false
        return ($passwordMatches) ? $user->id : false;
    }
    
}
