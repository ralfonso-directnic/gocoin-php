<?php

/**
 * Account Class
 *
 */

/*
Accounts - Manage accounts.
GoCoin currency accounts cannot be created or deleted.
#GET /merchants/:id/accounts Gets a list of accounts and balances associated with a merchant.
#GET /accounts/:id/transactions?start_time=:start_time&end_time=:end_time&page=:page_number&per_page=:per_page
  Gets a list of transactions associated with an account. Search by start_time and/or end_time. Supports pagination.
*/

class AccountService
{
  private $api;

  public function  __construct($api)
  {
    $this -> api = $api;
  }

  public function getAccounts($merchant_id)
  {
    $route = '/merchants/' . $merchant_id . '/accounts';
    return $this -> api -> request($route);
  }

  public function getAccountTransactions($account_id,$criteria=NULL)
  {
    $route = "/accounts/$account_id/transactions";
    if (!empty($criteria))
    {
      $route .= '?' . http_build_query($criteria);
    }
    return $this -> api -> request($route);
  }
}

?>