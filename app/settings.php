<?php
/**
 * Settings unique to the environment (i.e. development, production).
 * @todo Find a way to store these settings dynamically and configured based on automation
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */

 return $settings = [
    'displayErrorDetails' => true,
    'db' => [ // For PDO connection
        'host' => 'localhost',
        'dbname' => 'fitness',
        'user' => 'fitness',
        'pass' => 'ssentif'
        ],
    'orm' => [ // For Eloquent ORM
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'fitness',
        'username' => 'fitness',
        'password' => 'ssentif',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        ]
    ];
