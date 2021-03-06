<?php

ini_set('soap.wsdl_cache_enabled', 0);

// +---------------------------------------------------------------------------+
// | An absolute filesystem path to the youds/youds.php script.                |
// +---------------------------------------------------------------------------+
require('../../src/youds.php');

// +---------------------------------------------------------------------------+
// | An absolute filesystem path to our app/config.php script.                 |
// +---------------------------------------------------------------------------+
require('../app/config.php');

// +---------------------------------------------------------------------------+
// | Initialize the framework. You may pass an environment name to this method.|
// | By default the 'development' environment sets YoudsFramework into a debug mode.    |
// | In debug mode among other things the cache is cleaned on every request.   |
// +---------------------------------------------------------------------------+
YoudsFramework::bootstrap('development');

// +---------------------------------------------------------------------------+
// | Call the controller's dispatch method on the default context              |
// +---------------------------------------------------------------------------+
YoudsFrameworkContext::getInstance('soap')->getController()->dispatch();

?>
