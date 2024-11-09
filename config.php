<?php
// Start output buffering and session, set timezone to Manila
ob_start();
date_default_timezone_set('Asia/Manila');

// Database connection setup
include './connections/connections.php';

require_once('initialize.php');
// Redirect function to navigate to a specific URL
function redirect($url = '')
{
  if (!empty($url)) {
    echo '<script>location.href="' . base_url . $url . '"</script>';
  }
}

// Validate image function to check if the file exists and return its URL
function validate_image($file)
{
  global $_settings;

  if (!empty($file)) {
    $fileParts = explode("?", $file);
    $filePath = $fileParts[0];
    $timestamp = isset($fileParts[1]) ? "?" . $fileParts[1] : '';

    if (is_file(base_app . $filePath)) {
      return base_url . $filePath . $timestamp;
    } else {
      return base_url . $_settings->info('logo');
    }
  } else {
    return base_url . $_settings->info('logo');
  }
}

// Format number function to handle decimal places
function format_num($number = '', $decimal = '')
{
  if (is_numeric($number)) {
    $decimalCount = isset(explode(".", $number)[1]) ? strlen(explode(".", $number)[1]) : 0;

    if (is_numeric($decimal)) {
      return number_format($number, $decimal);
    } else {
      return number_format($number, $decimalCount);
    }
  } else {
    return "Invalid Input";
  }
}

// Function to check if the user is on a mobile device
function isMobileDevice()
{
  $mobileDevices = [
    '/iphone/i' => 'iPhone',
    '/ipod/i' => 'iPod',
    '/ipad/i' => 'iPad',
    '/android/i' => 'Android',
    '/blackberry/i' => 'BlackBerry',
    '/webos/i' => 'Mobile'
  ];

  foreach ($mobileDevices as $devicePattern => $deviceName) {
    if (preg_match($devicePattern, $_SERVER['HTTP_USER_AGENT'])) {
      return true;
    }
  }
  return false;
}

ob_end_flush();
