<?php

/**
 * User Class
 *
 */

/*
#GET /users Admin-Only: Gets a list of all users.
#POST /users Admin-Only: Adds a new user.
#GET /users/:id Gets an existing user.
#GET /user Gets resource owner user.
#PATCH /users/:id Updates an existing user.
#DELETE /users/:id Admin-Only: Deletes an existing user.
#PATCH /users/:id/password Changes user password.
#POST /users/request_password_reset Request password reset.
#PATCH /users/:id/reset_password/:reset_token Reset password.
#GET /users/:id/confirm_account/:confirmation_token Confirm user account.
#POST /users/request_new_confirmation_email Request new confirmation e-mail.
#GET /users/:user_id/applications
*/

class UserService
{
  private $api;

  public function __construct($api)
  {
    $this -> api = $api;
  }

  public function createUser($user)
  {
    $route = '/users';
    $options = array(
      'method' => 'POST',
      'body' => json_encode($user),
    );
    return $this -> api -> request($route, $options);
  }

  public function deleteUser($id)
  {
    $route = "/users/" . $id;
    $options = array(
      'method' => 'DELETE',
      'response_headers' => FALSE,
    );
    return $this -> api -> request($route, $options);
  }

  public function get($id)
  {
    $route = "/users/" . $id;
    return $this -> api -> request($route);
  }

  public function getUsers()
  {
    $route = '/users';
    return $this -> api -> request($route);
  }

  public function updateUser($user)
  {
    if (!is_array($user)) { throw new Exception("Invalid user object!"); }
    if (!array_key_exists('id',$user)) { throw new Exception("Invalid user object: missing id!"); }
    $id = $user['id'];
    $route = "/users/" . $id;
    $options = array(
      'method' => 'PATCH',
      'body' => json_encode($user),
    );
    return $this -> api -> request($route, $options);
  }

  public function self()
  {
    $route = '/user';
    return $this -> api -> request($route);
  }

  public function getUserApplications($id)
  {
    $route = '/users/' . $id . '/applications';
    return $this -> api -> request($route);
  }

  public function updatePassword($id,$password_array)
  {
    $route = "/users/" . $id . "/password";
    $options = array(
      'method' => 'PATCH',
      'body' => json_encode($password_array),
      'response_headers' => TRUE,
    );
    return $this -> api -> request($route, $options);
  }

  public function resetPassword($email)
  {
    if (empty($email)) { throw new Exception("Invalid email!"); }
    $route = '/users/request_password_reset';
    $options = array(
      'method' => 'POST',
      'body' => json_encode(array('email' => $email)),
      'response_headers' => TRUE,
    );
    return $this -> api -> request($route, $options);
  }

  public function resetPasswordWithToken($id,$reset_token,$password_array)
  {
    if (empty($id)) { throw new Exception("Missing reset user id!"); }
    if (empty($reset_token)) { throw new Exception("Missing reset token!"); }
    $route = '/users/' . $id . '/reset_password/' . $reset_token;
    $options = array(
      'method' => 'PATCH',
      'body' => json_encode($password_array),
      'response_headers' => TRUE,
    );
    return $this -> api -> request($route, $options);
  }

  public function requestConfirmationEmail($email)
  {
    if (empty($email)) { throw new Exception("Invalid email!"); }
    $route = '/users/request_new_confirmation_email';
    $options = array(
      'method' => 'POST',
      'body' => json_encode(array('email' => $email)),
      'response_headers' => TRUE,
    );
    return $this -> api -> request($route, $options);
  }

  public function confirmUser($id,$confirm_token)
  {
    if (empty($id)) { throw new Exception("Missing reset user id!"); }
    if (empty($confirm_token)) { throw new Exception("Missing confirmation token!"); }
    $route = '/users/' . $id . '/confirm_account/' . $confirm_token;
    $options = array(
      'method' => 'GET',
      'body' => NULL,
      'response_headers' => TRUE,
    );
    return $this -> api -> request($route, $options);
  }
}
?>
