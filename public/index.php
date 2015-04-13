<?php

use Phalcon\Mvc\Application;

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
     * Include services
     */
    require __DIR__ . '/../config/services.php';

    /**
     * Include services
     */
    require __DIR__ . '/../config/logger.php';
    
    /**
     * Handle the request
     */
    $application = new Application($di);

    /**
     * Include modules
     */
    require __DIR__ . '/../config/modules.php';

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