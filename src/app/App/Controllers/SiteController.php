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
        $response = $this->container->get('view')->render($response, "login.php");
        return $response;
    }
    
    public function processLogin($request, $response)
    {
        // Validate submission
        $data = $request->getParsedBody();
        $validSubmission = Login::validateSubmission($data);
        
        // Query database
        if ($validSubmission):
            $loginSuccess = User::getByLogin($this->container, $data);
        endif;
        
        // Redirect user accordingly
        if ($validSubmission && $loginSuccess):
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
