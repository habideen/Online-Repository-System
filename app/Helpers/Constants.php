<?php


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
