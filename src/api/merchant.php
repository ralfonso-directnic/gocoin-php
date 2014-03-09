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
