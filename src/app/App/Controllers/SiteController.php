<?php
namespace App\Controllers;

use \Slim\Container;

class SiteController {
    
    private $container;
    
    public function __construct(Container $c)
    {
        $this->container = $c;
    }
    
    public function showHome($request, $response)
    {
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
    
    public function showDashboard($request, $response)
    {
        $response = $this->container->get('view')->render($response, "dashboard.php");
        return $response;
    }
    
}
