<?php

// +---------------------------------------------------------------------------+
// | Should we run the system in debug mode? When this is on, there may be     |
// | various side-effects. But for the time being it only deletes the cache    |
// | upon start-up.                                                            |
// |                                                                           |
// | This should stay on while you're developing your application, because     |
// | many errors can stem from the fact that you're using an old cache file.   |
// |                                                                           |
// | This constant will be auto-set by YoudsFramework if you do not supply it.          |
// | The default value is: <false>                                             |
// +---------------------------------------------------------------------------+
// YoudsFrameworkConfig::set('core.debug', true);

// +---------------------------------------------------------------------------+
// | An absolute filesystem path to the youds package. This directory          |
// | contains all the YoudsFramework packages.                                          |
// |                                                                           |
// | This constant will be auto-set by YoudsFramework if you do not supply it.          |
// | The default value is the name of the directory "youds.php" resides in.    |
// +---------------------------------------------------------------------------+
// YoudsFrameworkConfig::set('core.youds_dir', '/Users/fgilcher/Sites/youds/branches/felix-testing-implementation/src');

// +---------------------------------------------------------------------------+
// | An absolute filesystem path to your web application directory. This       |
// | directory is the root of your web application, which includes the core    |
// | configuration files and related web application data.                     |
// | You shouldn't have to change this usually since it's auto-determined.     |
// | YoudsFramework can't determine this automatically, so you always have to supply it.|
// +---------------------------------------------------------------------------+
YoudsFrameworkConfig::set('core.app_dir', __DIR__);

// +---------------------------------------------------------------------------+
// | An absolute filesystem path to the directory where cache files will be    |
// | stored.                                                                   |
// |                                                                           |
// | NOTE: If you're going to use a public temp directory, make sure this is a |
// |       sub-directory of the temp directory. The cache system will attempt  |
// |       to clean up *ALL* data in this directory.                           |
// |                                                                           |
// | This constant will be auto-set by YoudsFramework if you do not supply it.          |
// | The default value is: "<core.app_dir>/cache"                              |
// +---------------------------------------------------------------------------+
// YoudsFrameworkConfig::set('core.cache_dir', YoudsFrameworkConfig::get('core.app_dir') . '/cache');

// +---------------------------------------------------------------------------+
// | You may also modify the following other directives in this file:          |
// |  - core.config_dir   (defaults to "<core.app_dir>/config")                |
// |  - core.lib_dir      (defaults to "<core.app_dir>/lib")                   |
// |  - core.model_dir    (defaults to "<core.app_dir>/models")                |
// |  - core.module_dir   (defaults to "<core.app_dir>/modules")               |
// |  - core.template_dir (defaults to "<core.app_dir>/templates")             |
// +---------------------------------------------------------------------------+

?>
