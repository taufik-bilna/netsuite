<?php

use Phalcon\Logger\Adapter\File as LoggerFile;

/**
 * Registering a logger
 */
$di['logger'] = function(){
    //$logger = new LoggerFile(__DIR__.'/../log/'.date("Ymd").'.log');
    $logger = new LoggerFile('/tmp/'.date("Ymd").'.log');
    return $logger;
};