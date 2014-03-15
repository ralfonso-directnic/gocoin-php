<?php

ini_set('display_errors', 1);

//include the config and the gocoin api
require_once(__DIR__.'/includes/config.php');
require_once(__DIR__.'/includes/functions.php');
require_once(__DIR__.'/../src/GoCoin.php');

//pick a token
$token = $TOKENS['full_access'];

//echo an HTML block
echo '<html><head><title>GoCoin Merchant Test</title></head><body>' . "\n";

echo '<h3 style="color:blue">Merchant</h3>';

//get a merchant
$merchant = GoCoin::getMerchant($token,MERCHANT_ID);
showObject($merchant,FALSE);

//update merchant tests
$UPDATE = FALSE;
if ($UPDATE)
{
    //create an array of fields to update, NOTE: id is required
  $name = $merchant -> name;
  $updates = array(
    'id' => $merchant -> id,
    'name' => $name . ' (UPDATED)',
  );

  //update the merchant
  $updated = GoCoin::updateMerchant($token,$updates);

  //show the updates
  echo '<h3 style="color:blue">Updated Merchant</h3>';
  showObject($updated,FALSE);

  //reset the name
  $updates['name'] = $name;
  GoCoin::updateMerchant($token,$updates);
}

echo '<hr/>' . "\n";
echo '<h3 style="color:blue">All Merchant Payouts</h3>';

//get all payouts
$payouts = GoCoin::getMerchantPayouts($token,MERCHANT_ID);
var_dump($payouts);

$DO_PAYOUT = FALSE;
if ($DO_PAYOUT)
{
  echo '<hr/>' . "\n";
  echo '<h3 style="color:blue">Payout</h3>';
  $payout = GoCoin::requestPayout($token,MERCHANT_ID,1);
  var_dump($payout);
  showObject($payout);
}

//get all conversions
echo '<hr/>' . "\n";
echo '<h3 style="color:blue">All Conversions</h3>';
$conversions = GoCoin::getCurrencyConversions($token,MERCHANT_ID);
var_dump($conversions);
if (!empty($conversions))
{
  foreach($conversions as $conversion)
  {
    showObject($conversion);
  }
}

//request a conversion
$DO_CONVERSION = TRUE;
if ($DO_CONVERSION)
{
  echo '<h3 style="color:blue">Requested Conversion</h3>';
  try
  {
    $conversion = GoCoin::requestCurrencyConversion($token,MERCHANT_ID,1);
    showObject($conversion);
  }
  catch (Exception $e)
  {
    //var_dump($e);
    echo '<div style="color:#aa0000">' . $e -> getMessage() . '</div>' . "\n";
  }
}

//show a specific conversion id
if (!empty(CONVERSION_ID))
{
  echo '<h3 style="color:blue">Specific Conversion</h3>';
  $specific = GoCoin::requestCurrencyConversion($token,MERCHANT_ID,1);
  showObject($specific);
}

//close our HTML block
echo '</body></html>' . "\n";
