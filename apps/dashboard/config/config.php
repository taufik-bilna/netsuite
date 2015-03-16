<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'dbname'     => 'bilna_api',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../controllers/',
        'modelsDir' => __DIR__ . '/../models/',
        'viewsDir' => __DIR__ . '/../views/',
        'baseUri' => '/ns/'
    ),
    'logger' => array(
        'path' => __DIR__.'/../../../logs/dashboard/',
        'name' => 'dashboard',
        'viewcache'    => __DIR__.'/../../../tmp/cache/',
    )
));
