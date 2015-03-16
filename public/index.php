<?php

use Phalcon\Mvc\Application;

ini_set('display_errors' , 1);
error_reporting(E_ALL);

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
    echo $e->getMessage();
}
