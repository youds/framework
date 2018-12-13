<?php

error_reporting(E_ALL | E_STRICT);

// +---------------------------------------------------------------------------+
// | An absolute filesystem path to the youds/youds.php script.                |
// +---------------------------------------------------------------------------+
require(__DIR__ . '/../../src/youds.php');

// +---------------------------------------------------------------------------+
// | An absolute filesystem path to our app/config.php script.                 |
// +---------------------------------------------------------------------------+
require(__DIR__ . '/../app/config.php');

// +---------------------------------------------------------------------------+
// | Initialize the framework. You may pass an environment name to this method.|
// | By default the 'development' environment sets YoudsFramework into a debug mode.    |
// | In debug mode among other things the cache is cleaned on every request.   |
// +---------------------------------------------------------------------------+
YoudsFramework::bootstrap('development');

// +---------------------------------------------------------------------------+
// | Call the controller's dispatch method on the default context              |
// +---------------------------------------------------------------------------+
YoudsFrameworkContext::getInstance('console')->getController()->dispatch();

?>
