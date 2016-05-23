<?php
/**
 * Main controller for the site.
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */
namespace App\Controllers;

use \Slim\Container;
use \App\Models\Login;
use \App\Models\User;

/**
 * Main controller for the site that manages the work to be done by route requests.
 * Divies up work between models, views, and simple procedural statements.
 */
class SiteController
{
    
    /**
     * @var array Application dependency container
     */
    private $container;
    
    /**
     * Inject dependency container upon instantiation of SiteController
     * 
     * @param \Slim\Container $c Dependency container
     * @return void
     */
    public function __construct(Container $c)
    {
        $this->container = $c;
    }
    
    /**
     * The home of the site. Redirects user based on if they are logged in.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     * @return void
     */
    public function showHome($request, $response)
    {
        // Check if user is logged in and redirect accordingly
        if (isset($_SESSION['userId'])):
            redirect_to('/my/dashboard');
        else:
            redirect_to('/login');
        endif;
    }
    
    /**
     * Display login form.
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     * @return \Slim\Http\Response PSR-7 Response
     */
    public function showLogin($request, $response)
    {
        $data = Login::initializeVars();
        
        $response = $this->container->get('view')->render($response, "login.php", ['data' => $data]);
        
        // Unset user's previous submission stored in session to prevent redisplay upon future requests
        unset($_SESSION['loginForm']);
        
        return $response;
    }
    
    /**
     * Manages the login process including validation, querying, putting a user's information in session
     * and redirecting.
     *
     * Session variables manipulated include $_SESSION['userId'] and $_SESSION['loginForm'], which
     * contains the submission ['submission'] and results ['validationResults'].
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     * @return void
     */    
    public function processLogin($request, $response)
    {
        
        // Validate submission
        $data = $request->getParsedBody();
        $validationResults = Login::validateSubmission($data);
        
        // Find user if valid submission
        if ($validationResults['validSubmission']):
        
            $userId = User::getIdByLogin($this->container, $data);
            
            // Store result of User ID query in SESSION, else set error message
            if ($userId):
                $_SESSION['userId'] = $userId;
            else:
                $validationResults['errors'][] = 'Username and password combination are incorrect.';
            endif;
            
        endif;
        
        // Put user's login submission and results into SESSION for future reference in other requests
        $_SESSION['loginForm']['submission'] = $data;
        $_SESSION['loginForm']['validationResults'] = $validationResults;
        
        // Redirect user to dashboard if submission valid and user found
        if ($validationResults['validSubmission'] && $userId):
            redirect_to('/my/dashboard');
        else:
            redirect_to('/login');
        endif;
    }
    
    /**
     * Simply shows the user's dashboard
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     * @return \Slim\Http\Response $response PSR-7 Response
     */    
    public function showDashboard($request, $response)
    {
        $response = $this->container->get('view')->render($response, "dashboard.php");
        return $response;
    }
    
    /**
     * Logs the user out by destroying SESSION and redirecting
     * 
     * @param \Slim\Http\Request $request PSR-7 Request
     * @param \Slim\Http\Response $response PSR-7 Response
     * @return void
     */   
    public function logoutUser($request, $response)
    {
        // Unset session vars, destroy session, redirect user
        $_SESSION = array();
        session_destroy();
        redirect_to('/login');
    }
    
}
