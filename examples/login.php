<?php

require_once(__DIR__.'/includes/config.php');
require_once(__DIR__.'/../src/GoCoin.php');

session_start();

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
