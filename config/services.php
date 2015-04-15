<?php

/**
 * Services are globally registered in this file
 */

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\DI\FactoryDefault;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Mvc\Router\Annotations as RouterAnnotations;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
//$di = new FactoryDefault();

/**
 * Registering a router
 */
$di['router'] = function () {

    /*$router = new Router();

    $router->setDefaultModule("dashboard");
    //$router->setDefaultNamespace("Api\\Core\\Controller\\");
    
    $router->add('/:module/:controller/:action', array(
        'module' => 1,
        'controller' => 2,
        'action' => 3
    ));
    
    $router->add('/:controller/:action', array(
        'module' => 1,
        'controller' => 1,
        'action' => 2
    ));

    $router->add('/logout', array(
        'module' => 'dashboard',
        'controller' => 'login',
        'action' => 'logout' 
    ));

    $router->removeExtraSlashes(true);

    return $router;*/

    //fix me (we must change below code to get all list modules)
    $modules = ['core', 'dashboard'];

    // Use the annotations router.
    $router = new RouterAnnotations(true);
    $router->setDefaultModule('dashboard');
    /*$router->setDefaultNamespace('Ns\Dashboard\Controllers');
    $router->setDefaultController("Index");
    $router->setDefaultAction("index");*/
//debug($modules);die;
    
    // Read the annotations from controllers.
    foreach ($modules as $module)
    {
        $moduleName = ucfirst($module);

        // Get all file names.
        $files = scandir( ROOT_PATH . '/apps/' . $module . '/controllers');
        // Iterate files.
        foreach ($files as $file)
        {
            if ($file == "." || $file == ".." || strpos($file, 'Controller.php') === false) {
                continue;
            }
            //$controller = 'Ns\\'.$moduleName . '\Controllers\\' . str_replace('Controller.php', '', $file);
            $controller = 'Ns\\'.$moduleName . '\Controllers\\' . str_replace('Controller.php', '', $file);
/*debug($files);
debug($module);*/
//debug($controller);            
            $router->addModuleResource(strtolower($module), $controller);
        }
    }
    $router->add('/:module/:controller/:action', array(
        'module' => 1,
        'controller' => 2,
        'action' => 3
    ));
    $router->add('/:controller/:action', array(
        'module' => 1,
        'controller' => 1,
        'action' => 2
    ));
    $router->removeExtraSlashes(true);

    return $router;
};

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

$di->set(
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
);