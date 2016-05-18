<?php

$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer("../templates/");
$container['\App\Controllers\SiteController'] = function ($c) {
    return new \App\Controllers\SiteController($c);
};
