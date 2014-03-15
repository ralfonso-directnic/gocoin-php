<?php

ini_set('display_errors', 1);

//include the config and the gocoin api
require_once(__DIR__.'/config.php');
require_once(__DIR__.'/functions.php');
require_once(__DIR__.'/../src/GoCoin.php');

//pick a token
$token = $TOKENS['full_access'];

//echo an HTML block
echo '<html><head><title>GoCoin Merchant User Test</title></head><body>' . "\n";

echo '<h3 style="color:blue">Merchant Users</h3>';

//get a list of all merchant users
$users = GoCoin::getMerchantUsers($token,MERCHANT_ID);
if (!empty($users))
{
  foreach($users as $key => $user)
  {
    showObject($user);
    echo '<hr/>' . "\n";
    //break;
  }
  //echo '<div style="color:#aa0000">NOTE: There are ' . (sizeof($users) - 1) . ' other merchant users not shown</div>';
}

//close our HTML block
echo '</body></html>' . "\n";
