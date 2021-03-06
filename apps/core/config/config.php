<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'  => 'Mysql',
        'host'     => '127.0.0.1',
        'username' => 'root',
        'password' => 'root',
        'dbname'     => 'bilna_netsuite_wolverine',
        'port'  => '4040'
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../controllers/',
        'modelsDir' => __DIR__ . '/../models/',
        'viewsDir' => __DIR__ . '/../views/',
        'baseUri' => '/ns/'
    ),
    'logger' => array(
        'path' => __DIR__.'/../../../logs/core/',
        'name' => 'core'
    )
));
