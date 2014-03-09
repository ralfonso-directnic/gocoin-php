<?php

/**
 * User Class
 *
 * @author Roman A <future.roman3@gmail.com>
 * @version 0.1.2
 *
 * @author Smith L <smith@gocoin.com>
 * @since  0.1.2
 */

/*
GET /users Admin-Only: Gets a list of all users.
POST /users Admin-Only: Adds a new user.
GET /users/:id Gets an existing user.
GET /user Gets resource owner user.
PATCH /users/:id Updates an existing user.
DELETE /users/:id Admin-Only: Deletes an existing user.
PATCH /users/:id/password Changes user password.
POST /users/request_password_reset Request password reset.
PATCH /users/:id/reset_password/:reset_token Reset password.
GET /users/:id/confirm_account/:confirmation_token Confirm user account.
POST /users/request_new_confirmation_email Request new confirmation e-mail.
GET /users/:user_id/applications
*/

class User
{
  private $api;

  public function __construct($api)
  {
    $this -> api = $api;
  }

  public function create($params)
  {
    $route = '/users';
    $options = array(
      'body' => $params['data']
    );
    return $this -> api -> request($route, $options);
  }

  public function delete($id)
  {
    $route = "/users/" . $id;
    $options = array(
      'method' => 'POST',
      'body' => $params['data']
    );
    return $this -> api -> request($route, $options);
  }

  public function get($id)
  {
    $route = "/users/" . $id;
    return $this -> api -> request($route);
  }

  public function _list()
  {
    $route = '/users';
    return $this -> api -> request($route);
  }

  public function update($params)
  {
    $route = "/users/" . $params['id'];
    $options = array(
      'method' => 'PATCH',
      'body' => $params['data']
    );
    return $this -> api -> request($route, $options);
  }

  public function self()
  {
    $route = '/user';
    return $this -> api -> request($route);
  }

  public function update_password($params)
  {
    $route = "/users/" . $params['id'] . "/password";
    $options = array(
      'method' => 'PATCH',
      'body' => $params['data']
    );
    return $this -> api -> request($route, $options);
  }

  public function request_password_reset($params)
  {
    $route = "/users/request_password_reset";
    $config = array(
      'host' => $this -> api -> client -> options['host'],
      'path' => "" . $this -> api -> client -> options['path'] . "/" . $this -> api -> client -> options['api_version'] . $route,
      'method' => 'POST',
      'port' => $this -> api -> client -> port(),
      'headers' => $this -> api -> client -> headers,
      'body' => $params['data']
    );
    return $this -> api -> client -> raw_request($config);
  }

  public function request_new_confirmation_email($params)
  {
    $route = "/users/request_new_confirmation_email";
    $config = array(
      'host' => $this -> api -> client -> $options['host'],
      'path' => "" . $this -> api -> client -> options['path'] . "/" . $this -> api -> client -> options['api_version'] . $route,
      'method' => 'POST',
      'port' => $this -> api -> client -> port(),
      'headers' => $this -> api -> client -> headers,
      'body' => $params['data']
    );
    return $this -> api -> client -> raw_request($config);
  }

  public function reset_password_with_token($params)
  {
    $route = "/users/" . $params['id'] . "/reset_password/" . $params['reset_token'];
    $config = array(
      'host' => $this -> api -> client -> options['host'],
      'path' => "" . $this -> api -> client -> options['path'] . "/" . $this -> api -> client -> options['api_version'] . $route,
      'method' => 'PATCH',
      'port' => $this -> api -> client -> port(),
      'headers' => $this -> api -> client -> headers,
      'body' => $params['data']
    );
    return $this -> api -> client -> raw_request($config);
  }
}
?>
