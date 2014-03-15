<?php

ini_set('display_errors', 1);

//include the config and the gocoin api
require_once(__DIR__.'/config.php');
require_once(__DIR__.'/functions.php');
require_once(__DIR__.'/../src/GoCoin.php');

//pick a token
$token = $TOKENS['full_access'];

//echo an HTML block
echo '<html><head><title>GoCoin Account Test</title></head><body>' . "\n";

echo '<h3 style="color:blue">Merchant Accounts</h3>';

//search invoices with criteria
$accounts = GoCoin::getAccounts($token,MERCHANT_ID);
if (!empty($accounts))
{
  foreach($accounts as $account)
  {
    showObject($account);
    echo '<hr/>' . "\n";
  }
}

if (!empty(ACCOUNT_ID))
{
  //example search criteria array
  $criteria = array(
    //'start_time' =>  '2014-03-14T00:00:00.000Z',
    //'end_time' => $end_time,
    //'page' => $page_number,
    'per_page' => 10,
  );

  echo '<h3 style="color:blue">Account Transactions</h3>';

  //search transactions with criteria
  $xactions = GoCoin::getAccountTransactions($token,ACCOUNT_ID);
  //var_dump($xactions);
  if (!empty($xactions) && $xactions -> paging_info -> total > 0)
  {
    foreach($xactions -> transactions as $xaction)
    {
      showObject($xaction);
      echo '<hr/>' . "\n";
    }
  }
  else
  {
    echo '<div style="color:#aa0000">There are no transactions for this account</div>' . "\n";
  }
}

//close our HTML block
echo '</body></html>' . "\n";
