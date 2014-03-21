<?php
  if (!file_exists(__DIR__.'/unit/config.php'))
  {
    copy(__DIR__.'/unit/config_test.php',__DIR__.'/unit/config.php');
  }
  require_once(__DIR__.'/unit/config.php');
  include_once('AutoLoader.php');
  // Register the directory to your include files
  AutoLoader::registerDirectory('src');
?>