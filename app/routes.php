<?php
/**
 * Set the routes the app responds to
 * @link http://www.slimframework.com/docs/objects/router.html
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', '\App\Controllers\SiteController:showHome');
$app->get('/login', '\App\Controllers\SiteController:showLogin');
$app->post('/login', '\App\Controllers\SiteController:processLogin');

// Routes that require logged in users
$app->group('/my', function () {
    $this->get('/dashboard', '\App\Controllers\SiteController:showDashboard');
    $this->get('/logout', '\App\Controllers\SiteController:logoutUser');
    
    $this->get('/workouts', '\App\Controllers\WorkoutsController:showWorkouts');
    $this->get('/workout', '\App\Controllers\WorkoutsController:showWorkout');
    $this->post('/workout', '\App\Controllers\WorkoutsController:addWorkout');
    $this->put('/workout', '\App\Controllers\WorkoutsController:updateWorkout');
    $this->delete('/workout', '\App\Controllers\WorkoutsController:deleteWorkout');
    
})->add($requireLoggedIn);
