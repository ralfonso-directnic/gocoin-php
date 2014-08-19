gocoin-PHP
===========

A PHP client library for the GoCoin API. Recommended: PHP version >= 5.3

## Usage

```php
require_once(__DIR__.'/src/GoCoin.php');

//get exchange rates
$exchange = GoCoin::getExchangeRates();

//get current user
$user = GoCoin::getUser($token);
...

//admin functions
require_once(__DIR__.'/src/GoCoinAdmin.php');

//get a list of merchants (admin only function)
$merchants = GoCoinAdmin::listMerchants($token);

//NOTE: by default, the GoCoin class points to the development server
//below is an example of how to switch to production mode

//switch to production mode
$mode = GoCoin::setApiMode('production');

//get an invoice (from production)
$invoice = GoCoin::getInvoice($token,$invoice_id);
...
```
## Methods

```php
//return the exchange rates
GoCoin::getExchangeRates()

//return a url to redirect to request an authorization code,
//used later for requesting a token
GoCoin::requestAuthorizationCode($client_id, $client_secret, $scope, $redirect_uri=NULL)

//return an access token given a previously requested authorization code
GoCoin::requestAccessToken($client_id, $client_secret, $code, $redirect_uri=NULL)
```

### User

```php
//return a user given an id, or, the current user if id is not provided
GoCoin::getUser($token,$id=NULL)

//return an updated user, after applying updates
GoCoin::updateUser($token,$user)

//return the user appplications
GoCoin::getUserApplications($token,$id)

//return a boolean if the password was successfully updated
GoCoin::updatePassword($token,$id,$password_array)

//return a boolean if the reset password request went through
GoCoin::resetPassword($token,$email)

//return a boolean if the reset password with token request went through
GoCoin::resetPasswordWithToken($token,$id,$reset_token,$password_array)

//return a boolean if the request confirmation email request went through
GoCoin::requestConfirmationEmail($token,$email)

//return a boolean if the user confirm was successful
GoCoin::confirmUser($token,$id,$confirm_token)
```

### Merchant

```php
//return a merchant given an id
GoCoin::getMerchant($token,$id)

//return an updated merchant, after applying updates
GoCoin::updateMerchant($token,$merchant)

//return the result of requesting a payout
GoCoin::requestPayout($token,$merchant_id,$amount,$currency='BTC')

//return a list of merchant payouts given a payout id, or, all payouts if id is not provided
GoCoin::getMerchantPayouts($token,$merchant_id,$payout_id=NULL)

//return the result of requesting a currency conversion
GoCoin::requestCurrencyConversion(
  $token,$merchant_id,$amount,$currency='BTC',$target='USD'
)

//return a list of currency conversions given a conversion id, or, all conversions if id is not provided
GoCoin::getCurrencyConversions($token,$merchant_id,$conversion_id=NULL)
```

### Merchant Users

```php
//return a list of merchant users given a merchant id
GoCoin::getMerchantUsers($token,$merchant_id)
```

### Invoices
```php
//get current user first

$user = GoCoin::getUser($token);

$merchant_id = $user->merchant_id;

//return the result of creating an invoice
GoCoin::createInvoice($token,$merchant_id,$invoice)

//return an invoice by id
GoCoin::getInvoice($token,$id)

//return the invoices that match the given criteria
GoCoin::searchInvoices($token,$criteria=NULL)
```

### Accounts

```php
//return the accounts for a given merchant
GoCoin::getAccounts($token,$merchant_id)

//return the transactions that match the given criteria
GoCoin::getAccountTransactions($token,$account_id,$criteria=NULL)
```

## Admin Methods

### User

```php
//return a list of users
GoCoinAdmin::listUsers($token)

//return a created user
GoCoinAdmin::createUser($token,$user)

//return a boolean representing the successful delete of a user
GoCoinAdmin::deleteUser($token,$id)
```

### Merchant

```php
//return an array of merchants
GoCoinAdmin::listMerchants($token)

//return an array of merchants
GoCoinAdmin::createMerchant($token,$merchant)

//return a merchant object after deleting it
GoCoinAdmin::deleteMerchant($token,$merchant_id)
```

### Merchant Users

```php
//return the result of adding a user to a merchant account
GoCoinAdmin::addMerchantUser($token,$merchant_id,$user_id)

//return the result of deleting a user from a merchant account
GoCoinAdmin::deleteMerchantUser($token,$merchant_id,$user_id)
```

## Running the unit tests


**NOTE:** ANT must be installed and on your PATH

**NOTE:** PHPUnit must be installed and on your PATH

**NOTE:** you may have to fill in the TEST_HOST and TEST_DASHBOARD_HOST constants in *src/GoCoin.php*

- execute the ANT target phpunit, ie: ant phpunit

**NOTE:** On the first execution, it will *copy test/unit/config_test.php* into *test/unit/config.php*.
It will also run a minimal test that does NOT require any client id, secret, tokens, etc.

- define the following variables in config.php:

  - CLIENT_ID
  - CLIENT_SECRET
  - TOKEN
  - USER_ID
  - MERCHANT_ID
  - INVOICE_ID
  - ACCOUNT_ID
  - MERCHANT_USER_ID

**NOTE:** If you do not know the respective ids, you can use the API to get them

- Change the constant *MINIMAL_TEST* to FALSE in test/unit/GoCoinTest.php

- execute the ANT target phpunit, ie: ant phpunit

**NOTE:** To execute the full ANT script, for full continuous integration and static analysis, you must install all the PHP tools as listed here, ie: phpmd, phpDox, etc.

  - http://jenkins-php.org/

### License

Copyright 2014 GoCoin Pte. Ltd.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
