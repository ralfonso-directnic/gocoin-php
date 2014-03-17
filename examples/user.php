<?php

ini_set('display_errors', 1);

//include the config and the gocoin api
require_once(__DIR__.'/includes/config.php');
require_once(__DIR__.'/includes/functions.php');
require_once(__DIR__.'/../src/GoCoin.php');

//pick a token
$token = $TOKENS['full_access'];

//echo an HTML block
echo '<html><head><title>GoCoin User Test</title></head><body>' . "\n";

//get the current user
$user = GoCoin::getUser($token);

//get a specific user
$specific = GoCoin::getUser($token,USER_ID);

//get the exchange rate from the gocoin web service
$exchange = GoCoin::getExchangeRates();

//echo an HTML block
echo '<html><head><title>GoCoin User Test</title></head><body>' . "\n";

//get the current version
echo '<h3 style="color:blue">Library Version</h3>';
$version = GoCoin::getVersion();
echo '<ul><li>' . $version . '</li></ul>';

//show the current exchange
echo '<h3 style="color:blue">Current Exchange</h3>';
showObject($exchange);

//show the current user
echo '<hr/>' . "\n";
echo '<h3 style="color:blue">Current User</h3>';
showObject($user);

//show the specific user
echo '<hr/>' . "\n";
echo '<h3 style="color:blue">Specific User</h3>';
showObject($specific);

//update user tests
$UPDATE = FALSE;
if ($UPDATE)
{
  //create an array of fields to update, NOTE: id is required
  $last_name = $user -> last_name;
  $updates = array(
    'id' => USER_ID,
    'last_name' => $last_name . ' updated',
  );

  //update the user
  $updated = GoCoin::updateUser($token,$updates);

  //show the updates
  echo '<h3 style="color:blue">Updated User</h3>';
  showObject($updated);

  //reset the last name
  $updates['last_name'] = $last_name;
  GoCoin::updateUser($token,$updates);
}

//show the applications
echo '<h3 style="color:blue">Applications</h3>';

//get the user applications
$apps = GoCoin::getUserApplications($token,USER_ID);
foreach($apps as $app) { showObject($app); }

//update password tests
$PASSWORD = FALSE;
if ($PASSWORD)
{
  echo '<h3 style="color:blue">Password Update Test</h3>';

  //an array to update the password
  $pw_array = array(
    "current_password" => "passw0rd",
    "password" => "newpassw0rd",
    "password_confirmation" => "newpassw0rd",
  );

  //update the password
  $pw_update = GoCoin::updatePassword($token,USER_ID,$pw_array);
  if ($pw_update -> code == '204') { echo '<div>Password successfully updated!</div>'; }
  else                             { echo '<div>Password update failure:</div>'; var_dump($pw_update); }

  //put the password back
  $pw_array = array(
    "current_password" => "newpassw0rd",
    "password" => "passw0rd",
    "password_confirmation" => "passw0rd",
  );

  //update the password back
  $pw_update = GoCoin::updatePassword($token,USER_ID,$pw_array);
  if ($pw_update -> code == '204') { echo '<div>Password successfully put back!</div>'; }
  else                             { echo '<div>Password update failure:</div>'; var_dump($pw_update); }
}

//reset password tests
$RESET = FALSE;
if ($RESET)
{
  echo '<h3 style="color:blue">Password Reset Test</h3>';

  if (empty(PW_RESET_TOKEN))
  {
    //request a password reset
    $reset_pw_req = GoCoin::resetPassword($token,USER_EMAIL);
    if ($reset_pw_req -> code == '204') { echo '<div>Password reset requested!</div>'; }
    else                                { echo '<div>Password reqest request failure:</div>'; var_dump($reset_pw_req); }
  }
  else
  {
    //create an array to reset the password with
    $pw_array = array(
      "password" => "passw0rd",
      "password_confirmation" => "passw0rd",
    );

    //reset a password
    $reset_pw = GoCoin::resetPasswordWithToken(
      $token,USER_ID,PW_RESET_TOKEN,$pw_array
    );
    if ($reset_pw -> code == '204') { echo '<div>Password reset successfully!</div>'; }
    else                            { echo '<div>Password reset failure:</div>'; var_dump($reset_pw); }
  }
}

//confirmation tests
$CONFIRM = FALSE;
if ($CONFIRM)
{
  echo '<h3 style="color:blue">Confirmation Test</h3>';

  if (empty(CONFIRM_TOKEN))
  {
    //request a confirmation email
    $confirm_email = GoCoin::requestConfirmationEmail($token,USER_EMAIL);
    if ($confirm_email -> code == '204')  { echo '<div style="color:#008800">Confirmation email requested!</div>'; }
    else                                  { echo '<div style="color:#aa0000">Confirmation email failure:</div>'; var_dump($confirm_email); }
  }
  else
  {
    //confirm a user account
    $confirm_account = GoCoin::confirmUser(
      $token,USER_ID,CONFIRM_TOKEN
    );
    if ($confirm_account -> code == '301') { echo '<div style="color:#008800">Confirm account success!</div>'; }
    else                                   { echo '<div style="color:#aa0000">Confirm account failure:</div>'; var_dump($confirm_account); }
    //the following code is an example of actually following
    //the redirect if one has been given in the method call
    $REDIRECT = FALSE;
    if ($REDIRECT)
    {
      if (property_exists($confirm_account, 'location'))
      {
        header("Location: ". $confirm_account -> location);
        return;
      }
    }
  }
}

//close our HTML block
echo '</body></html>' . "\n";
