<?php

/**
 * Account Class
 *
 * @author Roman A <future.roman3@gmail.com>
 * @version 0.1.2
 *
 * @author Smith L <smith@gocoin.com>
 * @since  0.1.2
 */

/*
Accounts - Manage accounts.
GoCoin currency accounts cannot be created or deleted.
GET /merchants/:id/accounts Gets a list of accounts and balances associated with a merchant.
GET /accounts/:id/transactions?start_time=:start_time&end_time=:end_time&page=:page_number&per_page=:per_page
  Gets a list of transactions associated with an account. Search by start_time and/or end_time. Supports pagination.
*/

class Accounts
{
  private $api;

  public function  __construct($api)
  {
    $this -> api = $api;
  }

  public function create($params)
  {
    $route = "/merchants/" . $params['id'] . "/accounts";
    $options = array (
      'method' => 'POST',
      'body' => $params['data']
    );
    return $this -> api -> request($route, $options);
  }

  public function get($id)
  {
    $route = "/accounts/" . $id;
    return $this -> api -> request($route);
  }

  public function update($params)
  {
    $route = "/accounts/" . $params['id'];
    $options = array(
      'method' => 'PATCH',
      'body' => $params['data']
    );
    return $this -> api -> request($route, $options);
  }

  public function alist($id)
  {
    $route = "/merchants/" . $id . "/accounts";
    return $this -> api -> request($route);
  }

  public function delete($id)
  {
    $route = "/accounts/" . $id;
    $options = array (
      'method' => 'DELETE'
    );
    return $this -> api -> request($route, $options);
  }

  public function verify($params)
  {
    $route = "/accounts/" . $params['id'] . "/verifications";
    $options = array(
      'method' => 'POST',
      'body' => $params['data']
    );
    return $this -> api -> request($route, $options);
  }
}

?>