<?php

// Register autoloaders for composer managed and own classes.
require '../vendor/autoload.php';
spl_autoload_register(function ($classname) {
    require "../app/" . str_replace('\\', '/', $classname) . ".php";
});

// Global functions
require '../app/functions.php';

// Application settings
$settings = require '../app/settings.php';

// Create app
$app = new \Slim\App(["settings" => $settings]);

// Add dependecies
require '../app/dependencies.php';

// Register routes
require '../app/routes.php';

// Run
$app->run();
