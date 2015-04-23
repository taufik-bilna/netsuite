<?php

/**
 * Services are globally registered in this file
 */

use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\DI\FactoryDefault;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Mvc\Router\Annotations as RouterAnnotations;

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di['url'] = function () {
    $url = new UrlResolver();
    //$url->setBaseUri('/api/');
    $url->setBaseUri('/');

    return $url;
};

/**
 * Start the session the first time some component request the session service
 */
$di['session'] = function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
};

$di->set('modelsManager', function() {
      return new Phalcon\Mvc\Model\Manager();
 });

/*$di->set(
    'annotations',
    function () {
        $annotationsAdapter = '\Phalcon\Annotations\Adapter\\Files';
        $adapter = new $annotationsAdapter(
            array (
            'annotationsDir' => ROOT_PATH . '/logs/var/cache/annotations/'
          )
        );
        
        return $adapter;
    },
    true
);*/