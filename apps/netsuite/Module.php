<?php

namespace Ns\Netsuite;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Logger\Adapter\File as FileAdapter;
use Phalcon\Logger\Multiple as MultipleStream;
use Phalcon\Events\Manager as EventsManager,
    Phalcon\Db\Profiler as DbProfiler;

use Ns\Dashboard\Plugin\Security as SecurityPlugin,
    Ns\Dashboard\Plugin\NotFound as NotFoundPlugin;
use Ns\Core\Libraries\Phalcon\Mvc\Application;

class Module implements ModuleDefinitionInterface
{
    use Application;
    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(array(
            'Ns\Netsuite\Controllers' => __DIR__ . '/controllers/',
            'Ns\Netsuite\Models'      => __DIR__ . '/models/',
            'Ns\Netsuite\Libraries'   => __DIR__ . '/libraries/',
            'Ns\Netsuite\Helpers'     => __DIR__ . '/helpers/',
            'Ns\Netsuite\Plugin'      => __DIR__ . '/plugin/',
        ));

        $loader->register();
    }

    /**
     * Registers the module-only services
     *
     * @param Phalcon\DI $di
     */
    public function registerServices($di)
    {

        /**
         * Read configuration
         */
        $config = include __DIR__ . "/config/config.php";

        /**
         * Registering config
         */
        $di['config'] = function () use($config) {
            return $config;
        };

        //Registering a dispatcher
        /*$di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Ns\Dashboard\Controllers");
            return $dispatcher;
        });*/
        /**
        * We register the events manager
        */
        $di->set('dispatcher', function() use ($di) {
            $eventsManager = new EventsManager;
            /**
            * Handle exceptions and not-found exceptions using NotFoundPlugin
            */
            $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);
            /**
            * Check if the user is allowed to access certain action using the SecurityPlugin
            */
//            $eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);
            
            $dispatcher = new Dispatcher;
            $dispatcher->setDefaultNamespace("Ns\Netsuite\Controllers");
            $dispatcher->setEventsManager($eventsManager);
            
            return $dispatcher;
       });

        /**
         * Setting up the view component
         */
        $di->set('view', function () use($config) {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');
            $view->registerEngines(array (
                
                '.volt' => function ($view, $di) use ($config) {
                    $volt = new Volt($view, $di);
                    $volt->setOptions(array (
                        'compiledPath' => $config->logger->viewcache,
                        'compiledSeparator' => '_',
                        'stat' => true,
                        'compileAlways' => true 
                    ));
        
                    return $volt;
                },
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
            ));

            return $view;
        }, true);

        $di['logger'] = function() use ($config){
            
            $path = $config->logger->path;
            
            if (! is_dir($path)) {
                mkdir($path, 0777, TRUE);
            }
            
            if(!is_writable($path)){
                $old = umask(0);
                @chmod($path, 0777);
                umask($old);
            }

            $logger = new MultipleStream();
            $logger->push(new FileAdapter($path.date("Ymd").'.log'));
            return $logger;
        };

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $this->_initCache($di, $config);
        $this->_initDatabase($di, $config);
        $this->_initComponent($di, $config);
        //$this->_initRouter($di, $config);
//        $di['db'] = function () use ($config) {
            /*$eventsManager = new \Phalcon\Events\Manager();
            $queryLogger = new \Ns\Dashboard\Libraries\Phalcon\Db\Profiler\QueryLogger();
            
            $logging = new FileAdapter("/tmp/dbXXXX.log");*/

//            $adapter = new DbAdapter(array(
//                "host" => $config->database->host,
//                "username" => $config->database->username,
//                "password" => $config->database->password,
//                "dbname" => $config->database->dbname,
//                "port" => $config->database->port
//            ));

            /*$eventsManager->attach('db', function($event, $adapter) use ($logging) {
                if ($event->getType() == 'beforeQuery') {
                    $logging->log($adapter->getSQLStatement());
                }
                if ($event->getType() == 'afterQuery') {
                    $logging->log($adapter->getSQLStatement(), \Phalcon\Logger::INFO);
                }
            });*/
            /*$eventsManager->attach('db', $queryLogger);
            //if ($config->debug) {
            if (true) {                
                $adapter->setEventsManager($eventsManager);
            }*/

//            return $adapter;
//        };


        //Set up the flash service
        $di['flash'] = function() {
            //return new \Phalcon\Flash\Direct();
            return new \Ns\Core\Libraries\Phalcon\Flash\Message(array(
                'error' => 'alert alert-block alert-danger fade in',
                'success' => 'alert alert-success fade in',
                'notice' => 'alert alert-warning fade in',
            ));
        };

    }

}
