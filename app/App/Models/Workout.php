<?php
/**
 * Workout model
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Models interaction with workouts entity in persistent data.
 * A workout consists of exercises done at a certain time and location.
 */
class Workout extends Model
{    
    /**
     * This function is an Eloquent convention that creates a relationship between the User and Workout models.
     *
     * @return \Illuminate\Database\Eloquent\Collection The user
     */
    public function user() {
        return $this->belongsTo('\App\Models\User');
    }
}
