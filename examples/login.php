<?php

require_once('../src/api.php');
require_once('../src/auth.php');
require_once('../src/client.php');

session_start();

/*
  Id      : your app client_id
  Secret  : your app secret id
  scope   : token scope
*/

//'PLACE_YOUR_CLIENT_ID_HERE'
//'PLACE_YOUR_CLIENT_SECRET_HERE'
const CLIENT_ID = '661b989eda4e39e65456646f3a214e35039a8823666916dac717f746afa34018';
const CLIENT_SECRET = '977691490acff424973dfcf3fa32ba5161c7cda673af7b69a82c232e943f668b';
//const REDIRECT_URL = 'http://localhost/gocoin/gocoin-php/examples/login.php';
const REDIRECT_URL = 'http://www.google.com';
//const SCOPE = 'user_read user_read_write';
const SCOPE = 'account_read user_read user_read_write user_password_write merchant_read merchant_read_write invoice_read invoice_write invoice_read_write oauth_read oauth_read_write';
//const SCOPE = 'account_read user_read user_read_write user_password_write merchant_read merchant_read_write invoice_read invoice_write invoice_read_write';

//user_read invoice_read_write
//const TOKEN = 'bbeb99deacd6c6c732fc584c90720eb34052759dc7b622adb3178b24b9bc864c';
//full access token
const TOKEN = '300c62c18a0b6c0cc8111b0555ce388361a215a8e35b3907f93b3fc39d125faa';

const TOKENS = array(
  'basic' => 'bbeb99deacd6c6c732fc584c90720eb34052759dc7b622adb3178b24b9bc864c',
  'full_access' => '300c62c18a0b6c0cc8111b0555ce388361a215a8e35b3907f93b3fc39d125faa',
);

$headers = array(
  'Content-Type' => 'application/json',
  'Cache-Control' => 'no-cache',
);

$client = new Client(
  array(
    'client_id' => CLIENT_ID,
    'client_secret' => CLIENT_SECRET,
    'scope' => SCOPE,
    'redirect_uri' => REDIRECT_URL,     //NOTE: leave this out to use the current URL
    'headers' => $headers,
  )
);

$client -> initToken();
$b_auth = $client -> authorize_api();

if ($b_auth)
{
  $token = $client -> getToken();
  echo "Access Token: " . $token . '<br/>';
}
else
{
  echo $client -> getError() . '<br/>';
}

?>

<html>
  <body>
    <?php if (!$b_auth) { ?>
      <a target="gocoin" href="<?php echo $client -> get_auth_url();?>">Login Go Coin</a>
    <?php } ?>
  </body>
</html>
