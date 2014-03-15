<?php

const CLIENT_ID     = 'PLACE_YOUR_CLIENT_ID_HERE';
const CLIENT_SECRET = 'PLACE_YOUR_CLIENT_SECRET_HERE';
const REDIRECT_URL  = 'http://www.google.com';
const SCOPE         = 'account_read user_read user_read_write user_password_write merchant_read merchant_read_write invoice_read invoice_write invoice_read_write oauth_read oauth_read_write';

//pick a token, any token
$TOKENS = array(
  'basic' => 'YOUR_BASIC_ACCESS_TOKEN',
  'dashboard' => 'A_TOKEN_PROVIDED_BY_DASHBOARD',
  'full_access' => 'FULL_ACCESS_TOKEN',
);
