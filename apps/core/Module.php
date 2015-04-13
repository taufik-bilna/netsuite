<?php

namespace Ns\Core;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Logger\Adapter\File as FileAdapter;
use Phalcon\Logger\Multiple as MultipleStream;
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
            'Ns\Core\Controllers' => __DIR__ . '/controllers/',
            'Ns\Core\Models' => __DIR__ . '/models/',
            'Ns\Core\Libraries' => __DIR__ . '/libraries/',
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
        $di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Ns\Core\Controllers");
            return $dispatcher;
        });
        /**
         * Setting up the view component
         */
        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');

            return $view;
        };

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
        $this->_initDatabase($di, $config);
        /*$di['db'] = function () use ($config) {
            return new DbAdapter(array(
                "host" => $config->database->host,
                "username" => $config->database->username,
                "password" => $config->database->password,
                "dbname" => $config->database->dbname,
                "port" => $config->database->port
            ));
        };*/

    }

}
