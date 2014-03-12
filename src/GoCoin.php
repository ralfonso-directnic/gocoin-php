<?php

/**
 * GoCoin Api
 * A PHP-based GoCoin client library with a focus on simplicity and ease of integration
 */

class GoCoin
{
  /**
   * @return a Client object
   */
  static public function getClient($token)
  {
    return Client::getInstance($token);
  }
}

   #     #     #  #######  #######  #        #######     #     ######   
  # #    #     #     #     #     #  #        #     #    # #    #     #  
 #   #   #     #     #     #     #  #        #     #   #   #   #     #  
#     #  #     #     #     #     #  #        #     #  #     #  #     #  
#######  #     #     #     #     #  #        #     #  #######  #     #  
#     #  #     #     #     #     #  #        #     #  #     #  #     #  
#     #   #####      #     #######  #######  #######  #     #  ######   

/**
 * SPL autoloader.
 * @param string $class_name the name of the class to load
 */
function GoCoinAutoload($class_name)
{
  $dirs = array(
    __DIR__ . '/',
    __DIR__ . '/services/',
    __DIR__ . '/utils/',
  );
  //support case insensitivity
  $class_names = array($class_name,strtolower($class_name));
  foreach($class_names as $class_name)
  {
    foreach($dirs as $dir)
    {
      $file = $dir . $class_name . '.php';
      if (file_exists($file)) {
        include_once($file);
        return;
      }
      if (strpos($class_name, "_")) {
        $file = $dir . str_replace("_", "/", $class_name) . ".php";
        if (file_exists($file)) {
          include_once($file);
          return;
        }
      }
      $file = $dir . $class_name . '.class.php';
      if (file_exists($file)) {
        include_once($file);
        return;
      }
    }
  }
  die("[ERROR]: class [$class_name] cannot be auto loaded!");
}

if (version_compare(PHP_VERSION, '5.3.0', '>='))
{
  spl_autoload_register('GoCoinAutoload', TRUE, TRUE);
}
else
{
  spl_autoload_register('GoCoinAutoload');
}


?>