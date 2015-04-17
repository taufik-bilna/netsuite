<?php

use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;

ini_set('display_errors' , 1);
error_reporting(E_ALL);
define('DS', DIRECTORY_SEPARATOR);
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(dirname(__FILE__)));
}
if (!defined('PUBLIC_PATH')) {
    define('PUBLIC_PATH', dirname(__FILE__));
}
try {
    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
    $di = new FactoryDefault();
    /**
     * Handle the request
     */
    $application = new Application($di);

    /**
     * Include modules
     */
    require __DIR__ . '/../config/modules.php';
    
    /**
     * Include routes
     */
    require __DIR__ . '/../config/routes.php';

    /**
     * Include services
     */
    require __DIR__ . '/../config/services.php';

    /**
     * Include services
     */
    require __DIR__ . '/../config/logger.php';

    echo $application->handle()->getContent();

} catch (Exception $e) {
    echo "error index php ".$e->getMessage();
    exit;
}
function debug($m)
{
    echo '<pre>';
    if( is_array($m) || is_object($m) )
    {
        print_r($m);
    }else
    {
        echo $m;
    }
    echo '<pre>';
}