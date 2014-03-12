<?php

/**
 * Merchant Class
 *
 * @author Roman A <future.roman3@gmail.com>
 * @version 0.1.2
 *
 * @author Smith L <smith@gocoin.com>
 * @since  0.1.2
 */

/*
GET /merchants Admin-Only: Gets a list of all merchants.
POST /merchants Admin-Only: Adds a new merchant.
GET /merchants/:id Gets an existing merchant.
PATCH /merchants/:id Updates an existing merchant.
DELETE /merchants/:id Admin-Only: Deletes an existing merchant.
POST /merchants/:merchant_id/payouts Requests a new payout.
GET /merchants/:merchant_id/payouts/:id Gets an existing merchant payout.
GET /merchants/:merchant_id/payouts Gets a list of all payouts for a merchant.
POST /merchants/:merchant_id/currency_conversions Requests a new currency conversion.
GET /merchants/:merchant_id/currency_conversions/:id Gets an existing currency_conversion.
GET /merchants/:merchant_id/currency_conversions Gets a list of all currency_conversion for a merchant.
*/

class Merchant
{
  private $api;

  public function __construct($api)
  {
    $this -> api = $api;
  }

  public function create($params)
  {
    $route = '/merchants';
    $options = array(
      'method' => 'POST',
      'body' =>  $params
    );
    return $this -> api -> request($route, $options);
  }

  public function delete($id)
  {
    $route = "/merchants/" . $id;
    $options = array(
      'method' => 'DELETE'
    );
    return $this -> api -> request($route, $options);
  }

  public function get($id)
  {
    $route = "/merchants/" . $id;
    return $this -> api -> request($route);
  }

  public function _list()
  {
    $route = '/merchants';
    return $this -> api -> request($route);
  }

  public function update($params, $callback)
  {
    $route = "/merchants/" . $params['id'];
    $options = array(
      'method' => 'PATCH',
      'body' => $params['data']
    );
    return $this -> api -> request($route, $options);
  }
}
?>
