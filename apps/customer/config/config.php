<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'  => 'mongo',
        'host'     => '127.0.0.1',
        'username' => '',
        'password' => '',
        'dbname'     => 'bilna_netsuite_wolverine',
        'port'  => '27017'
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../controllers/',
        'modelsDir' => __DIR__ . '/../models/',
        'viewsDir' => __DIR__ . '/../views/',
        'baseUri' => '/ns/'
    ),
    'logger' => array(
        'path' => __DIR__.'/../../../logs/customer/',
        'name' => 'customer',
        'viewcache'    => __DIR__.'/../../../tmp/cache/',
    )
));
