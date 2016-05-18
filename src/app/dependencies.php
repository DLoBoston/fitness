<?php

$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer("../templates/");
