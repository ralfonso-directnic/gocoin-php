<?php

/**
 * Invoice Class
 *
 * @author Roman A <future.roman3@gmail.com>
 * @version 0.1.2
 *
 * @author Smith L <smith@gocoin.com>
 * @since  0.1.2
 */

/*
POST /merchants/:id/invoices Create a new invoice.
GET /invoices/:id Gets an invoice.
GET /invoices/search?merchant_id=:merchant_id&status=:status&start_time=:start_time&end_time=:end_time&page=:page_number&per_page=:per_page
      Searches invoices.
*/

class Invoices
{
  private $api;

  public function __construct($api)
  {
    $this -> api = $api;
  }

  public function create($params)
  {
    $route = "/merchants/" . $params['id'] . "/invoices";
    $options = array(
      'method' => 'POST',
      'body' => $params['data']
    );
    return $this -> api -> request($route, $options);
  }

  public function get($id)
  {
    $route = "/invoices/" . $id;
    return $this -> api -> request($route);
  }

  public function search($params)
  {
    $params = http_build_query($params);
    $route = "/invoices/search?" . $params;
    return $this -> api -> request($route);
  }

  public function update($params)
  {
    $route = "/invoices/" . $params['id'];
    $options = array(
      'method' => 'PATCH',
      'body' => $params['data']
    );
    return $this -> api -> request($route, $options);
  }
}
?>