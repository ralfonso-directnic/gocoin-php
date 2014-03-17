<?php

ini_set('display_errors', 1);

//include the config and the gocoin api
require_once(__DIR__.'/../includes/config.php');
require_once(__DIR__.'/../includes/functions.php');
require_once(__DIR__.'/../../src/GoCoin.php');

//pick a token
$token = $TOKENS['full_access'];

//echo an HTML block
echo '<html><head><title>GoCoin Admin Merchant Test</title></head><body>' . "\n";

echo '<h3 style="color:blue">Merchants</h3>';

//get a list of merchants (admin only function)
$merchants = GoCoinAdmin::listMerchants($token);
if (!empty($merchants))
{
  foreach($merchants as $merchant)
  {
    showObject($merchant);
    //echo '<hr/>' . "\n";
    break;
  }
  echo '<div style="color:#aa0000">NOTE: There are ' . (sizeof($merchants) - 1) . ' other merchants not shown</div>';
}

//create merchant tests
$CREATE = FALSE;
$DELETE_ID = '';
if ($CREATE)
{
  //create an array of fields to create a merchant
  $create = array(
    'name' => 'Another Test Merchant for Aaron',
  );

  //create the merchant
  $created = GoCoinAdmin::createMerchant($token,$create);

  //show the created merchant
  echo '<h3 style="color:blue">Created Merchant</h3>';
  showObject($created);

  //get the id to delete
  //NOTE: in the test I ran, I did not get back an id here
  //$DELETE_ID = $created -> id;
}

if (!empty($DELETE_ID))
{
  //delete the merchant
  $deleted = GoCoinAdmin::deleteMerchant($token,$DELETE_ID);

  if ($deleted) { echo '<div style="color:#008800">Merchant deleted successfully!</div>'; }
  else          { echo '<div style="color:#aa0000">Deletion failed!</div>'; }
}

//close our HTML block
echo '</body></html>' . "\n";
