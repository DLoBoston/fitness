<?php
namespace App\Controllers;

use \Slim\Container;
use \App\Models\Login;
use \App\Models\User;

class SiteController {
    
    private $container;
    
    public function __construct(Container $c)
    {
        $this->container = $c;
    }
    
    public function showHome($request, $response)
    {
        // Check if user is logged in and redirect accordingly
        if (isset($_SESSION['userId'])):
            redirect_to('/dashboard');
        else:
            redirect_to('/login');
        endif;
    }
    
    public function showLogin($request, $response)
    {
        $data = Login::initializeVars();
        
        $response = $this->container->get('view')->render($response, "login.php", ['data' => $data]);
        
        // Unset user's previous submission stored in session to prevent redisplay upon future requests
        unset($_SESSION['loginForm']);
        
        return $response;
    }
    
    public function processLogin($request, $response)
    {
        
        // Validate submission
        $data = $request->getParsedBody();
        $validationResults = Login::validateSubmission($data);
        
        // Query database if valid submission
        if ($validationResults['validSubmission']):
        
            $userId = User::getIdByLogin($this->container, $data);
            
            // Store result of User ID query in SESSION
            $_SESSION['userId'] = $userId;
            
            // Set error message if applicable
            if (!$userId):
                $validationResults['errors'][] = 'Username and password combination are incorrect.';
            endif;
            
        endif;
        
        // Put user's login submission and results into SESSION for future reference in other requests
        $_SESSION['loginForm']['submission'] = $data;
        $_SESSION['loginForm']['validationResults'] = $validationResults;
        
        // Redirect user to dashboard if submission valid and user found
        if ($validationResults['validSubmission'] && $userId):
            redirect_to('/dashboard');
        else:
            redirect_to('/login');
        endif;
    }
    
    public function showDashboard($request, $response)
    {
        $response = $this->container->get('view')->render($response, "dashboard.php");
        return $response;
    }
    
}
