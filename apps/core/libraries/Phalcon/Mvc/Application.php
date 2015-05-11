<?php

namespace Ns\Core\Libraries\Phalcon\Mvc;

use Phalcon\Mvc\Router\Annotations as RouterAnnotations;
use Ns\Core\Libraries\Phalcon\Cache\System;
use Ns\Core\Libraries\Phalcon\Cache\Dummy;

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
    	if( $config->database->adapter == 'mongo' )
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
        }else{
            $di['mongo'] = function () use ($config) {
                
                $mongo = new \MongoClient("mongodb://" .
                   $config->database->username . ":"
                   $config->database->password . "@" . 
                   $config->database->host,array("db" => $config->database->dbname)
                );
                return $mongo->selectDb($config->database->dbname);
            };
        }
    }

    /**
     * Init router.
     *
     * @param DI     $di     Dependency Injection.
     * @param Config $config Config object.
     *
     * @return Router
     */
    public static function initRouter($di)
    {
        $cacheData = $di->get('cacheData');
        $router = $cacheData->get(System::CACHE_KEY_ROUTER_DATA);

        if( $router === null )
        {
            $saveToCache = ($router === null);

            //fix me (we must change below code to get all list modules)
            $modules = ['core', 'dashboard'];

            // Use the annotations router.
            $router = new RouterAnnotations(true);
            $router->setDefaultModule('dashboard');
            /*$router->setDefaultNamespace('Ns\Dashboard\Controller');
            $router->setDefaultController("Index");
            $router->setDefaultAction("index");*/
debug($modules);die;
            // Read the annotations from controllers.
            foreach ($modules as $module)
            {
                $moduleName = ucfirst($module);

                // Get all file names.
                $files = scandir( ROOT_PATH . '/apps/' . $module . '/controllers/');
                // Iterate files.
                foreach ($files as $file)
                {
                    if ($file == "." || $file == ".." || strpos($file, 'Controller.php') === false) {
                        continue;
                    }
                    $controller = 'Ns\\'.$moduleName . '\Controller\\' . str_replace('Controller.php', '', $file);
                    $router->addModuleResource(strtolower($module), $controller);
                }
            }
            if ($saveToCache) {
                $cacheData->save(System::CACHE_KEY_ROUTER_DATA, $router, 2592000); // 30 days cache
            }
        }
        $di->set('router', $router);
    }

    /**
     * Init cache.
     *
     * @param DI     $di     Dependency Injection.
     * @param Config $config Config object.
     *
     * @return void
     */
    protected function _initCache($di, $config)
    {
        // Create a dummy cache for system.
        // System will work correctly and the data will be always current for all adapters.
        $dummyCache = new Dummy(null);
        $di->set('viewCache', $dummyCache);
        $di->set('cacheOutput', $dummyCache);
        $di->set('cacheData', $dummyCache);
        $di->set('modelsCache', $dummyCache);
    }

    /**
     * Init Component Element
     *
     * @param DI     $di     Dependency Injection.
     * @param Config $config Config object
     *
     * @return void  
     */
    protected function _initComponent($di, $config)
    {
        $di->set('elements', function(){
            return new User\Elements();
        });
    }
}