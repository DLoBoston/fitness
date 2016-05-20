<?php

// Application middleware to start session on every request
$app->add(function ($request, $response, $next)) {
    session_start();
	$response = $next($request, $response);
	return $response;
});

// Callable closure that can be added to routes to ensure users are logged in
$requireLoggedIn = function ($request, $response, $next) {
    if (!isset($_SESSION['userId'])):
        redirect_to('/login');
    endif;
	$response = $next($request, $response);
	return $response;
};
