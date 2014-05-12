<?php
  if ( !defined('__DIR__') ) define('__DIR__', dirname(__FILE__)); //5.2.x compatibility
  if (!file_exists(__DIR__.'/unit/config.php'))
  {
    copy(__DIR__.'/unit/config_test.php',__DIR__.'/unit/config.php');
  }
  require_once(__DIR__.'/unit/config.php');
  include_once('AutoLoader.php');
  // Register the directory to your include files
  AutoLoader::registerDirectory('src');
?>