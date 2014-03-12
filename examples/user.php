<?php

//require_once('../src/api.php');
//require_once('../src/auth.php');
//require_once('../src/client.php');

//pick a token, any token
$TOKENS = array(
  'basic' => 'bbeb99deacd6c6c732fc584c90720eb34052759dc7b622adb3178b24b9bc864c',
  'dashboard' => 'd18b6ed5299f59400ca4fdf1db3ec34b010a2569f8cf9c5c05a8d9f00ef57ae9',
  'full_access' => '300c62c18a0b6c0cc8111b0555ce388361a215a8e35b3907f93b3fc39d125faa',
);

require_once('../src/GoCoin.php');

//create a new client with an already granted token
$client = GoCoin::getClient($TOKENS['full_access']);

//var_dump($client);
//die("STOPPING");

//create a new client with an already granted token
$client = Client::getInstance($TOKENS['full_access']);

//get the current user
$user = $client -> api -> user -> self();
if (!$user) { echo $client -> getError(); }

// get the exchange rate from the gocoin web service
$get_the_xrate = $client -> get_xrate();
if (!$get_the_xrate) { echo $client -> getError(); }

?>

<html>
  <body>
    <?php if ($user) { ?>
    <h3>Current User</h3>
    <ul>
      <li><b>User Id:</b>      <?php echo $user -> id?></li>
      <li><b>User Email:</b>   <?php echo $user -> email?></li>
      <li><b>First Name:</b>   <?php echo $user -> first_name?></li>
      <li><b>Last Name:</b>    <?php echo $user -> last_name?></li>
      <li><b>Created Date:</b> <?php echo $user -> created_at?></li>
      <li><b>Updated Date:</b> <?php echo $user -> updated_at?></li>
      <li><b>Image Url:</b>    <?php echo $user -> image_url?></li>
      <li><b>Merchant Id:</b>  <?php echo $user -> merchant_id?></li>
    </ul>
    <?php } ?>
    <h3>Current Exchange</h3>
    <?php if ($get_the_xrate) { ?>
    <ul>
      <li><b>Timestamp:</b> <?php echo $get_the_xrate -> timestamp; ?></li>
      <li><b>Exchange Rate (BTC):</b> $<?php echo $get_the_xrate -> prices -> BTC -> USD; ?></li>
      <li><b>Exchange Rate (LTC):</b> $<?php echo $get_the_xrate -> prices -> LTC -> USD; ?></li>
    </ul>
    <?php } ?>
  </body>
</html>
