<?php

ini_set('display_errors', 1);

//include the config and the gocoin api
require_once(__DIR__.'/../includes/config.php');
require_once(__DIR__.'/../includes/functions.php');
require_once(__DIR__.'/../../src/GoCoinAdmin.php');

//pick a token
$token = $TOKENS['full_access'];

//echo an HTML block
echo '<html><head><title>GoCoin Admin User Test</title></head><body>' . "\n";

//get the current user
$user = GoCoin::getUser($token);

//get a list of users (admin only function)
$users = GoCoinAdmin::listUsers($token);

//show the current user
echo '<hr/>' . "\n";
echo '<h3 style="color:blue">Current User</h3>';
showObject($user);

//show the application users
echo '<hr/>' . "\n";
echo '<h3 style="color:blue">Application Users</h3>';
if (!empty($users))
{
  foreach($users as $u)
  {
    showObject($u);
    echo '<hr/>' . "\n";
    break;
  }
  echo '<div style="color:#aa0000">NOTE: There are ' . (sizeof($users) - 1) . ' other users not shown</div>';
}

//create user tests
$CREATE = FALSE;
$DELETE_ID = '';
if ($CREATE)
{
  //create an array of fields to create a user
  $creates = array(
    'email' => 'foo@bar.com',
    'first_name' => 'Foo',
    'last_name' => 'Bar',
    'password' => 'password',
    'password_confirmation' => 'password',
  );

  //create the user
  $created = GoCoinAdmin::createUser($token,$creates);

  //show the created user
  echo '<h3 style="color:blue">Created User</h3>';
  showObject($created);

  //get the id to delete
  $DELETE_ID = $created -> id;
}

if (!empty($DELETE_ID))
{
  //delete the user
  $deleted = GoCoinAdmin::deleteUser($token,$DELETE_ID);

  if ($deleted) { echo '<div style="color:#008800">User deleted successfully!</div>'; }
  else          { echo '<div style="color:#aa0000">Deletion failed!</div>'; }
}

//close our HTML block
echo '</body></html>' . "\n";
