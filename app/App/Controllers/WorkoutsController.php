<?php
/**
 * Controller to manage interacting with workouts on the site.
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */
namespace App\Controllers;

use \Slim\Container;
use \App\Models\User;

/**
 * Controller to manage interacting with workouts on the site via route requests.
 * Divies up work between models, views, and simple procedural statements.
 */
class WorkoutsController
{    
    /**
     * @var array Application dependency container
     */
    private $container;
    
    /**
     * Inject dependency container upon instantiation of controller
     * 
     * @param \Slim\Container $c Dependency container
     * @return void
     */
    public function __construct(Container $c)
    {
        $this->container = $c;
    }
    
    /**
     * Display list of existing workouts for the logged in user via the user dashboard.
     * User is found with SESSION['userId']. Provide links to CRUD actions.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     * @return \Slim\Http\Response PSR-7 Response
     */
    public function showWorkouts($request, $response) {
        
        // Connect to ORM
        $this->container->get('orm');
        
        // Get the logged in user's workouts
        $workouts = User::find($_SESSION['userId'])->workouts()->orderBy('workout_date', 'desc')->get();
        
        // Display
        $response = $this->container->get('view')->render($response, "partials/workouts.php", ["workouts" => $workouts]);
        return $response;
    }
    
    /**
     * Display workout details. If no ID is provided, show form.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     * @return \Slim\Http\Response PSR-7 Response
     */
    public function showWorkout($request, $response) {
        $response->getBody()->write("showWorkout");
        return $response;
    }
    
    /**
     * Validate workout submission and add to data store if valid.
     * Redirect to workouts list if submission valid, or back to form on fail.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     * @return void
     */
    public function addWorkout($request, $response) {
        redirect_to('/my/workouts');
    }
    
    /**
     * Validate workout submission and update data store if valid.
     * Redirect to workouts list if submission valid, or back to form on fail.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     * @return void
     */
    public function updateWorkout($request, $response) {
        redirect_to('/my/workouts');
    }
    
    /**
     * Delete workout, then redirect to workouts list.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     * @return void
     */
    public function deleteWorkout($request, $response) {
        redirect_to('/my/workouts');
    }
    
}
