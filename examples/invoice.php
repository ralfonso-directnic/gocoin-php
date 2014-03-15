<?php

ini_set('display_errors', 1);

//include the config and the gocoin api
require_once(__DIR__.'/config.php');
require_once(__DIR__.'/functions.php');
require_once(__DIR__.'/../src/GoCoin.php');

//pick a token
$token = $TOKENS['full_access'];

//echo an HTML block
echo '<html><head><title>GoCoin Invoice Test</title></head><body>' . "\n";

echo '<h3 style="color:blue">All Invoices</h3>';

//search invoices with no criteria, returns all of em
$invoices = GoCoin::searchInvoices($token);
if (!empty($invoices) && property_exists($invoices, 'invoices'))
{
  echo '<ul>' . "\n";
  foreach($invoices -> invoices as $invoice)
  {
    echo '  <li>';
    echo '<b>Id:</b> ' . $invoice -> id;
    echo ' (created at ' . $invoice -> created_at . ')';
    echo '</li>'. "\n";
  }
  echo '</ul>' . "\n";
}

//example search criteria array
$criteria = array(
  'merchant_id' => MERCHANT_ID,
  //'status' => $status,
  'start_time' =>  '2014-03-14T00:00:00.000Z',
  //'end_time' => $end_time,
  //'page' => $page_number,
  'per_page' => 10,
);

echo '<hr/>' . "\n";
echo '<h3 style="color:blue">Recent Invoices</h3>';

//search invoices with criteria
$invoices = GoCoin::searchInvoices($token,$criteria);
if (!empty($invoices) && property_exists($invoices, 'invoices'))
{
  foreach($invoices -> invoices as $invoice)
  {
    showObject($invoice);
    echo '<hr/>' . "\n";
  }
}

echo '<h3 style="color:blue">Specific Invoices</h3>';

//get a specific invoice
$specific = GoCoin::getInvoice($token,INVOICE_ID);
showObject($invoice);

$NEW_INVOICE = FALSE;
if ($NEW_INVOICE)
{
  echo '<hr/>' . "\n";
  echo '<h3 style="color:blue">New Invoice</h3>';
  //create a new invoice
  $new_invoice = array(
    'price_currency' => 'BTC',
    'base_price' => '456.00',
    'base_price_currency' => 'USD',
    'notification_level' => 'all',
    'confirmations_required' => 5,
  );
  $new_invoice = GoCoin::createInvoice($token,MERCHANT_ID,$new_invoice);
  //var_dump($new_invoice);
  showObject($new_invoice);
}

//close our HTML block
echo '</body></html>' . "\n";
