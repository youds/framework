<?php

YoudsFrameworkConfig::set('core.testing_dir', realpath(__DIR__));
YoudsFrameworkConfig::set('core.app_dir', realpath(__DIR__.'/../app/'));
YoudsFrameworkConfig::set('core.cache_dir', YoudsFrameworkConfig::get('core.app_dir') . '/cache'); // for the clearCache() before bootstrap()

?>
