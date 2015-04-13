<?php

namespace Ns\Core\Libraries\Phalcon\Mvc;

//use Phalcon\Mvc\Application as PhalconApplication;

trait Application
{
	/**
     * Init database.
     *
     * @param DI            $di            Dependency Injection.
     * @param Config        $config        Config object.
     *
     * @return Pdo
     */
    protected function _initDatabase($di, $config)
    {
    	$di['db'] = function () use ($config) {
            
            $adapter = '\Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
        	/** @var Pdo $connection */
        	$connection = new $adapter(
	            [
	                "host" => $config->database->host,
	                "port" => $config->database->port,
	                "username" => $config->database->username,
	                "password" => $config->database->password,
	                "dbname" => $config->database->dbname,
	            ]
	        );
            return $connection;
        };
    }
}