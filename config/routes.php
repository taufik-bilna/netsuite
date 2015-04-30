<?php
/**
 * Annotations Routes 
 *
 * //fix me (we must change below code to get all list modules)
 *   //$modules = ['core', 'dashboard'];
 *
 *   // Use the annotations router.
 *   $router = new RouterAnnotations(true);
 *   $router->setDefaultModule('dashboard');
 *   //$router->setDefaultNamespace('Ns\Dashboard\Controllers');
 *   //$router->setDefaultController("Index");
 *   //$router->setDefaultAction("index");
 *
 *   // Read the annotations from controllers.
 *   foreach ($modules as $module)
 *   {
 *       $moduleName = ucfirst($module);
 *
 *       // Get all file names.
 *       $files = scandir( ROOT_PATH . '/apps/' . $module . '/controllers');
 *       // Iterate files.
 *       foreach ($files as $file)
 *       {
 *           if ($file == "." || $file == ".." || strpos($file, 'Controller.php') === false) {
 *               continue;
 *           }
 *           //$controller = 'Ns\\'.$moduleName . '\Controllers\\' . str_replace('Controller.php', '', $file);
 *           $controller = 'Ns\\'.$moduleName . '\Controllers\\' . str_replace('Controller.php', '', $file);
 *          
 *           $router->addModuleResource(strtolower($module), $controller);
 *       }
 *   }
 *
 *
 *   return $router;
 */


/**
 * Routes are globally registered in this file
 */

use Phalcon\Mvc\Router;

/**
 * Registering a router
 */
$di['router'] = function () {

    $router = new Router();

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

    $router->add('/login', array(
        'module' => 'dashboard',
        'controller' => 'login',
        'action' => 'index' 
    ));

    $router->add('/logout', array(
        'module' => 'dashboard',
        'controller' => 'login',
        'action' => 'logout' 
    ));

    $router->add('/dashboard', array(
        'module' => 'dashboard',
        'controller' => 'index',
        'action' => 'index' 
    ));

    $router->add('/users/edit/:int', array(
        'module' => 'user',
        'controller' => 'user',
        'action' => 'edit',
        'id' => 1 
    ))->setName("admin-users-edit");

    $router->add('/users/delete/:int', array(
        'module' => 'user',
        'controller' => 'user',
        'action' => 'delete',
        'id' => 1 
    ))->setName("admin-users-delete");

    $router->removeExtraSlashes(true);

    return $router;

    //fix me (we must change below code to get all list modules)
    //$modules = ['core', 'dashboard'];

    // Use the annotations router.
/*    $router = new RouterAnnotations(true);
    $router->setDefaultModule('dashboard');
    //$router->setDefaultNamespace('Ns\Dashboard\Controllers');
    //$router->setDefaultController("Index");
    //$router->setDefaultAction("index");

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
           
            $router->addModuleResource(strtolower($module), $controller);
        }
    }


    return $router;*/
};