<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', '\App\Controllers\SiteController:showHome');
$app->get('/login', '\App\Controllers\SiteController:showLogin');
$app->post('/login', '\App\Controllers\SiteController:processLogin');

// Routes that require logged in users
$app->group('/my', function () {
    $this->get('/dashboard', '\App\Controllers\SiteController:showDashboard');
    $this->get('/logout', '\App\Controllers\SiteController:logoutUser');
})->add($requireLoggedIn);
