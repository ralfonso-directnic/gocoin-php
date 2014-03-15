<?php

/**
 * Merchant User Service Class
 *
 */

/*
#Merchant Users - Manage the users that are associated with a merchant.
GET /merchants/:id/users Gets a list of all merchant users.
###PUT /merchants/:merchant_id/users/:user_id Admin-Only: Adds a user to a merchant account.
  => 404 Not Found
###DELETE /merchants/:merchant_id/users/:user_id Admin-Only: Deletes a user from a merchant account.
  => 404 Not Found
*/

class MerchantUserService
{
  private $api;

  public function  __construct($api)
  {
    $this -> api = $api;
  }

  public function getMerchantUsers($merchant_id)
  {
    $route = '/merchants/' . $merchant_id . '/users';
    return $this -> api -> request($route);
  }

  public function addMerchantUser($merchant_id,$user_id)
  {
    $route = '/merchants/' . $merchant_id . '/users/' . $user_id;
    $options = array(
      'method' => 'PUT',
      'response_headers' => TRUE,
    );
    return $this -> api -> request($route, $options);
  }

  public function deleteMerchantUser($merchant_id,$user_id)
  {
    $route = '/merchants/' . $merchant_id . '/users/' . $user_id;
    $options = array(
      'method' => 'DELETE',
      'response_headers' => TRUE,
    );
    return $this -> api -> request($route, $options);
  }
}

?>