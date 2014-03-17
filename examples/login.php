<?php

require_once(__DIR__.'/includes/config.php');
require_once(__DIR__.'/../src/GoCoin.php');

//request a token if we're been redirected back to here with a code
if (array_key_exists('code', $_REQUEST))
{
  try
  {
    $token = GoCoin::requestAccessToken(CLIENT_ID, CLIENT_SECRET, $_REQUEST['code'], REDIRECT_URL);
    echo '<div><b>Token: </b>' . $token . '</div>' . "\n";
    echo '<div><b>Scope: </b>' . SCOPE . '</div>' . "\n";
  }
  catch (Exception $e)
  {
    echo '<div style="color:#aa0000">Error: ' . $e -> getMessage() . '</div>' . "\n";
  }
}
//redirect to the authorization url
else
{
  $auth_url = GoCoin::requestAuthorizationCode(
    CLIENT_ID, CLIENT_SECRET, SCOPE, REDIRECT_URL
  );
  header("Location: $auth_url");
  return;
}
?>
