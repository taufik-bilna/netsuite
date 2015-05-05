<?php
use Phalcon\Loader;

/**
 * Register application modules
 */
$modulesPath = ['core', 'dashboard', 'system', 'netsuite'];

foreach($modulesPath as $module)
{
    $moduleName = ucfirst($module);
    $bootstrap[$module]['className'] = 'Ns\\'.$moduleName . '\Module';
    $bootstrap[$module]['path'] = __DIR__ . '/../apps/'.$module.'/Module.php';
}

$application->registerModules($bootstrap);

/**
 * Register namespace modules
 */
$loader = new Loader();

$loader->registerNamespaces(array(
    'Ns\Core\Controllers' 	=> __DIR__ . '/../apps/core/controllers/',
    'Ns\Core\Models' 		=> __DIR__ . '/../apps/core/models/',
    'Ns\Core\Libraries' 	=> __DIR__ . '/../apps/core/libraries/',
    'Ns\Dashboard\Controllers'   => __DIR__ . '/../apps/dashboard/controllers/',
    'Ns\Dashboard\Models'        => __DIR__ . '/../apps/dashboard/models/',
    'Ns\Dashboard\Libraries'     => __DIR__ . '/../apps/dashboard/libraries/',
    'Ns\Dashboard\Plugin'      => __DIR__ . '/../apps/dashboard/plugin/',
));

$loader->register();