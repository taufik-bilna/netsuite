<?php

namespace Ns\Core\Libraries\Phalcon\Cache;

use Phalcon\Cache\Backend;

/**
 * System cache keys.
 *
 * @package   Ns\Core\Libraries\Phalcon\Cache
 * @copyright 
 * 
 */
class System
{
    const
        /**
         * Cache key for router data.
         */
        CACHE_KEY_ROUTER_DATA = 'router_data',

        /**
         * Widgets metadata, stored from modules.
         */
        CACHE_KEY_WIDGETS_METADATA = 'widgets_metadata';

}