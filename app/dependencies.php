<?php
/**
 * Dependency container. Contains standard PDO connection as well Eloquent ORM
 * @link http://www.slimframework.com/docs/concepts/di.html
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */

$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer("../templates/");
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host={$db['host']};dbname={$db['dbname']}", $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
$container['orm'] = function ($c) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($c['settings']['orm']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};
$container['\App\Controllers\SiteController'] = function ($c) {
    return new \App\Controllers\SiteController($c);
};
$container['\App\Controllers\WorkoutsController'] = function ($c) {
    return new \App\Controllers\WorkoutsController($c);
};
