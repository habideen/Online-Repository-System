<?php

use App\Models\Session;

define('TITLE', ['Mr', 'Mrs', 'Dr', 'Prof']);
define('GENDER', ['M', 'F']);
define('PAGINATION', 50);
define('DB_UPDATE_ERROR', 'System error! Please try again later');
define('SERVER_ERROR', 'System error! Please try again later');
define('VALID_FILE_TYPE', ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'png', 'gif', 'jpg', 'jpeg']);


if (!function_exists('auth_messages')) {
  function auth_messages($message)
  {
    $messages = [
      'guest_reg_error' => 'You are not authorized to registered as an admin.',
      'registration' => 'Account registration was successful.',
      'login_error' => 'Login credentials is incorrect.',
      'throttle_message' => 'Too many attempts. Try again after 1 minute.',
      'verify_email' => 'Please verify your email'
    ];

    return (array_key_exists($message, $messages)) ? $messages[$message] : '';
  }
}


if (!function_exists('currentSession')) {
  function currentSession()
  {
    $session = Session::select('session')->latest()->first();

    return $session->session ?? null;
  }
}
