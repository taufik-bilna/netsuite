<?php
use Phalcon\Loader;

/**
 * Register application modules
 */
$application->registerModules(array(
    'core' => array(
        'className' => 'Ns\Core\Module',
        'path' => __DIR__ . '/../apps/core/Module.php'
    ),
	'dashboard' => array(
		'className' => 'Ns\Dashboard\Module',
		'path' => __DIR__ . '/../apps/dashboard/Module.php'
	)
));

/**
 * Register namespace modules
 */
$loader = new Loader();

$loader->registerNamespaces(array(
    'Ns\Core\Controllers' 	=> __DIR__ . '/../apps/core/controllers/',
    'Ns\Core\Models' 		=> __DIR__ . '/../apps/core/models/',
    'Ns\Core\Libraries' 	=> __DIR__ . '/../apps/core/libraries/',
));

$loader->register();